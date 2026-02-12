<?php
$items=[
["codigo"=>"P001","nombre"=>"Cadena","precio"=>30],
["codigo"=>"P002","nombre"=>"Bujía","precio"=>8]
];
foreach($items as $i){
echo "<p>{$i['codigo']} - {$i['nombre']} $ {$i['precio']}</p>";
}
?>