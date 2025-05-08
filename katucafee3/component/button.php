<?php function ButtonText($text="text",$class="btn-primary",$type="button"){
    return "<button type='$type' class='btn $class'>$text</button>";
}

function label($for="",$class="",$text=""){
return "<lable class='$class',for='$for'>$text</lable>";
}
?>