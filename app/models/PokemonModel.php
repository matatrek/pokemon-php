<?php 
namespace Models;

use PDO;
use PDOException;

class PokemonModel {

    protected static $db;
    protected static $table = 'pokemons';
    protected static $primaryKey = 'id';

    public static function setConnection(PDO $connection) : void {
        self::$db = $connection;
    }

    private static function baseResponse() : object {
        return (object)[
            'status' => false,
            'data'   => [],
            'error'  => null
        ];
    }

    public static function consult(object $data) : object {
        $response = self::baseResponse();

        try {
            $bind  = $data->bind ?? [];
            $query = $data->query ?? '';

            $stmt = self::$db->prepare($query);
            $stmt->execute($bind);

            while ($record = $stmt->fetch()) {
                $response->data[] = $record;
            }
            $stmt->closeCursor();

            $response->status = true;
        } catch (PDOException $pdo) {
            $response->error = $pdo->getMessage();
        } finally {
            return $response;
        }
    }

    public static function all() : object {
        $query = "SELECT * FROM " . self::$table;
        return self::consult((object)[
            'query' => $query,
        ]);
    }

    public static function select(array $columns) : object {
        $columns = implode(',', $columns);
        $query = "SELECT " . $columns . " FROM " . self::$table;
        return self::consult((object)[
            'query' => $query,
        ]);
    }
}