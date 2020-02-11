<?php

$pdo = new \PDO('mysql:host=mysql;dbname=beetroot', 'root', 'rootpass');
$sql = $pdo->prepare('SELECT * FROM categories_menu');
$sql->execute();
$categories = $sql->fetchAll(PDO::FETCH_ASSOC);

$categories_tree = [];

/*function categories_tree($categories) {
    foreach ($categories as $category) {
        if ($category['parent_id'] == 0) {
            $category_tree[$category['id']] = ['name'=>$category['name'], 'children'=> []];
        } else {
            $category_tree[$category['parent_id']]['children'][] =  ['name'=>$category['name']];
        }

    }
    return $category_tree;
}*/





function categories_tree($categories)
{

    $arr_cat = [];
    if ($arr_cat[$categories['parent_id']] == 0) {
        $arr_cat[$categories['parent_id']] = [];
    }
    $arr_cat[$categories['parent_id']][] = $categories;

    return $arr_cat;
}


$categories_tree = categories_tree($categories);
echo '<pre>';
print_r($categories_tree);


