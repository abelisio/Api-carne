<?php

namespace App\Models;

class Carne
{
    private static $table = 'carnes';
    private static $table_par = 'parcelas';

    public static function select(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetch(\PDO::FETCH_OBJ);

            return $resultado;
        } else {
            throw new \Exception("Nenhum carnê encontrado!");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum carnê encontrado!");
        }
    }
    public static function insert($data)
    {
        $valor_entrada = $data['valor_entrada'];
        $total = $data['total'];
        $valor_total = $data['valor_total'];
        $date = date_create($data['data_vencimento']);
        $data_vencimento = date_format($date, "Y/m/d ");
        $valor = $data['valor'] ;
        $numero = $data['numero'] ;
        $entrada =  $valor_entrada == '' || $valor_entrada == 0 ? 'FALSE' : 'TRUE';
        $numero_parcelas = $data['quantidade_parcelas'];

        // Cálculo das parcelas
        $valor_por_parcela = ($data['valor_total'] - $data['entrada']) / $data['quantidade_parcelas'];
        $data_vencimento = $data['data_primeiro_vencimento'];

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . '
         (valor_total, quantidade_parcelas, data_primeiro_vencimento, periodicidade, valor_entrada) 
         VALUES (:valor_total, :quantidade_parcelas, :data_primeiro_vencimento, :periodicidade, :valor_entrada)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':valor_total', $data['valor_total']);
        $stmt->bindValue(':quantidade_parcelas', $data['quantidade_parcelas']);
        $stmt->bindValue(':data_primeiro_vencimento', $data['data_primeiro_vencimento']);
        $stmt->bindValue(':periodicidade', $data['periodicidade']);
        $stmt->bindValue(':valor_entrada', $data['valor_entrada']);
        $stmt->execute();


        $carne_id = $connPdo->lastInsertId();


        if ($entrada > 0) {

            $sql = 'INSERT INTO ' . self::$table_par . '
         (carne_id, total, data_vencimento, valor, numero, entrada, valor_por_parcela ) 
         VALUES (:carne_id, :total, :data_vencimento, :valor, :numero, :entrada, :valor_por_parcela)';
            $stmt = $connPdo->prepare($sql);

            $stmt->bindValue(':carne_id', $carne_id);
            $stmt->bindValue(':total', $total);
            $stmt->bindValue(':data_vencimento', $data_vencimento);
            $stmt->bindValue(':valor', $valor);
            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':entrada', $entrada);
            $stmt->bindValue(':valor_por_parcela', $valor_por_parcela);
            $stmt->execute();

            $numero++;
        }

        $lista_parcelas = [];

        for ($i = 2; $i <= $numero_pacrelas; $i++) {

            $lista_parcelas[] = number_format($valor_por_parcela, 2);

            $sql = 'INSERT INTO ' . self::$table_par . '
         (carne_id, total, data_vencimento, valor, numero, entrada, valor_por_parcela ) 
         VALUES (:carne_id, :total, :data_vencimento, :valor, :numero, :entrada, :valor_por_parcela)';
            $stmt = $connPdo->prepare($sql);

            $stmt->bindValue(':carne_id', $carne_id);$stmt->bindValue(':total', $total);
            $stmt->bindValue(':data_vencimento', $data_vencimento);
            $stmt->bindValue(':valor', $valor);
            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':entrada', $entrada);
            $stmt->bindValue(':valor_por_parcela', $valor_por_parcela);
            $stmt->execute();

            // Ajustar a data de vencimento conforme a periodicidade
            if ($periodicidade == 'mensal') {
                $data_vencimento->modify('+1 month');
            } else if ($periodicidade == 'semanal') {
                $data_vencimento->modify('+1 week');
            }

            $numero++;
        }
        if ($stmt->rowCount() > 0) {

            $saida = array(
                'valor_total' => number_format($valor_total,2),
                'valor_entrada' => $valor_entrada,
                'parcelas' => $lista_parcelas,
                'data_vencimento' => $data_vencimento,
                'valor' => number_format($valor_por_parcela, 2),
                'numero' => $numero,
                'entrada' => $entrada
            );
            return $saida; 
            
            throw new \Exception("Falha ao inserir dados do Carnê!");
        }
    }
}