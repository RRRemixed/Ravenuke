<?php



/*New Code
echo "<a href=\"javascript:;\" onclick=\"if(document.getElementById('mydiv$i').style.display == 'none'){ document.getElementById('mydiv$i').style.display = 'block'; }else{ document.getElementById('mydiv$i').style.display = 'none'; }\">Toggle Div Visibility $i</a>";
echo "<div id='mydiv$i' style='display:none'><h3>This is a test! $i<br>Can you see me?</h3></div>";
*/


//Old code
// Hidden / show java. Examples of use
/*
echo "<div id='deviltag1' class='deviltag1hidden'>";
echo "<p>This was hidden.</p>";
echo "</div>";
*/
// Use onlick to call or close
/*
echo "<a name='alaslakl' onclick='deviltag1();'><u>infohere</u></a>";
*/

?>
<style type="text/css" media="screen">
div.visible {
display: deviltag1visible;
}
div.deviltag1hidden {
display: none;
}
</style>

<script type="text/javascript">
function deviltag1() {
var deviltag1 = document.getElementById('deviltag1');
if ( deviltag1.className == 'deviltag1hidden' ) {
deviltag1.className = 'deviltag1visible';
} else {
deviltag1.className = 'deviltag1hidden';
}
}
</script>


<style type="text/css" media="screen">
div.visible {
display: deviltag2visible;
}
div.deviltag2hidden {
display: none;
}
</style>

<script type="text/javascript">
function deviltag2() {
var deviltag2 = document.getElementById('deviltag2');
if ( deviltag2.className == 'deviltag2hidden' ) {
deviltag2.className = 'deviltag2visible';
} else {
deviltag2.className = 'deviltag2hidden';
}
}
</script>

<style type="text/css" media="screen">
div.visible {
display: deviltag3visible;
}
div.deviltag3hidden {
display: none;
}
</style>

<script type="text/javascript">
function deviltag3() {
var deviltag3 = document.getElementById('deviltag3');
if ( deviltag3.className == 'deviltag3hidden' ) {
deviltag3.className = 'deviltag3visible';
} else {
deviltag3.className = 'deviltag3hidden';
}
}
</script>

<style type="text/css" media="screen">
div.visible {
display: deviltag4visible;
}
div.deviltag4hidden {
display: none;
}
</style>

<script type="text/javascript">
function deviltag4() {
var deviltag4 = document.getElementById('deviltag4');
if ( deviltag4.className == 'deviltag4hidden' ) {
deviltag4.className = 'deviltag4visible';
} else {
deviltag4.className = 'deviltag4hidden';
}
}
</script>






<?




?>