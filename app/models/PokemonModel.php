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

    public static function all(object $request) : object {
        $attack     = $request->attack;
        $defense    = $request->defense;
        $speed      = $request->speed;
        $search     = $request->search;
        $type       = json_decode($request->type);
        $bind       = [];
        $conditions = [];

        $query = "SELECT * FROM " . self::$table . " WHERE id IS NOT NULL";

        if ($attack) {
            $query .= " AND attack BETWEEN 0 AND " . $attack;
        }

        if ($defense) {
            $query .= " AND defense BETWEEN 0 AND " . $defense;
        }

        if ($speed) {
            $query .= " AND speed BETWEEN 0 AND " . $speed;
        }
        if ($search) {
            $query .= " AND name LIKE ('%".$search."%')";
        }

        if (count($type)) {
            $bind = [];
            $conditions = [];
            foreach ($type as $value) {
                $bind[":$value"] = "%$value%";
                $conditions[]    = "type LIKE (:$value)";
            }
            $query .= " AND " . implode(' OR ', $conditions);
        }

        return self::consult((object)[
            'query' => $query,
            'bind'  => $bind
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