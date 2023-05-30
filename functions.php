<?php
//****************************************renvoyer un tableau d'articles *********************/
function getArticles(){
    return [
        //***************article 1***************************** */
        [
            'name'=> 'Robe longue',
            'id'=> '1',
            'price' => 129.99,
            'description' => 'L\'élégance',
            'detailedDescription' => 'Robe longue aux jolies couleurs estivales, elle égaiera vos plus belles soirées',
            'picture' => 'robe1.jpg'
        ],
        //**************article 2***************************** */
        [
            'name' =>'Robe à fleurs',
            'id'=> '1',
            'price' => 109.99,
            'description' => 'Un air estival',
            'detailedDescription' => 'Robe sans manches, fluide, elle vous accompagnera en toute circonstance tout l\'été',
            'picture' => 'robe2.jpg'
        ],
        //**************article 3***************************** */
        [
            'name'=> 'Robe blanche',
            'id'=> '1',
            'price' => 159.99,
            'description' => 'Robe de soirée',
            'detailedDescription' => 'Robe longue aux jolies couleurs estivales, elle égaiera vos plus belles soirées',
            'picture' => 'robe3.jpg'
        ]
    ];
}