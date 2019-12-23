<?php


class Test
{
    public $insert = "INSERT INTO beetroot (login, email, password) VALUE ('petro', 'petro@petro@com, 'petro')";
    public $update = "UPDATE beetroot SET(status=2) WHERE email LIKE '%@gmail.com'";
    public $delete = 'DELETE FROM users LEFT JOIN news
                        ON users.id = news.user_id
                        WHERE user.status=1, news.';
    public $select = "SELECT ''
    FROM 'users'
    LEFT JOIN news ON user.id = news.user_id";

}
