<?php
require_once('conexao.php');
require_once('books.php');

class booksDAO {
    public function create(Books $books) {
        $sql = 'INSERT INTO books (titulo, autor, genero) VALUES (?, ?, ?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $books->getTitulo());
        $stmt->bindValue(2, $books->getAutor());
        $stmt->bindValue(3, $books->getGenero());
        $stmt->execute();
    }

    public function read($id) {
        $sql = 'SELECT * FROM books WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }

    public function update(Books $books) {
       $sql = 'UPDATE books SET titulo = ?, autor = ?, genero = ? WHERE id = ?';
       $stmt = Conexao::getConn()->prepare($sql);
       $stmt->bindValue(1, $books->getTitulo());
       $stmt->bindValue(2, $books->getAutor());
       $stmt->bindValue(3, $books->getGenero());
       $stmt->bindValue(4, $books->getId());
       $stmt->execute();
    }

    public function delete(Books $books) {
        $sql = 'DELETE FROM books WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $books->getId());
        $stmt->execute();
    }

    public function allBooks() {
        $sql = 'SELECT * FROM books';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }
}


// $books1 = new Books('A metamorfose', 'Franz Kafka', 'Psicológico', 1918);
// $booksDAO = new booksDAO();
// $booksDAO->create($books1);