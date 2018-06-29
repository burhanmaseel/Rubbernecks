
<script>
<?php
$js_array = json_encode($super);
echo "charts = ". $js_array . ";\n";
?>
var prep1 = [];
var prep = JSON.parse(charts)
for(j=0;j<prep.length;j++)
{
      prep1.push(
        {
          label:String(prep[j].c_name),
          y:parseInt((prep[j].c_id))
        }
      )

}

var x = {
theme: "light1", // "light2", "dark1", "dark2"
animationEnabled: false, // change to true
title:{
text: "Basic Column Chart"
},
data:prep1

}; // use this x in graphs
</script>
