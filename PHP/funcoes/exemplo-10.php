<?PHP

function test($callback){
    $callback();
}

test(function(){
    echo "terminou";
});

?>