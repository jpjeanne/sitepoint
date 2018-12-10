<?php

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    // the execute() method iterates over the passed in array and
    // binds values in the statement
    $query->execute($parameters);
    return $query;
}

function getJoke($pdo, $id) {
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];
	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
	return $query->fetch();
}

function allJokes($pdo) {
    $jokes =  query($pdo, 'SELECT `joke`.`id`, `joketext`, `name`, `email`
            FROM `joke` INNER JOIN `author`
            ON `authorid` = `author`.`id`');

    return $jokes->fetchAll();
}

function totalJokes($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

function insertJoke($pdo, $joketext, $authorId) {
    $query = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorId`)
              VALUES (:joketext, CURDATE(), :authorId)';

    $parameters = [
        ':joketext' => $joketext,
        ':authorId' => $authorId];

    query($pdo, $query, $parameters);
}

function updateJoke($pdo, $jokeId, $joketext, $authorId) {
    $parameters = [
        ':joketext' => $joketext,
        ':authorId' => $authorId,
        ':id'       => $jokeId];

    query($pdo, 'UPDATE `joke` SET `authorId` = :authorId,
     `joketext` = :joketext WHERE `id` = :id', $parameters);
}

function deleteJoke($pdo, $id) {
    $parameters = [':id' => $id];

    query($pdo, 'DELETE FROM `joke` WHERE `id` = :id', $parameters);
}
