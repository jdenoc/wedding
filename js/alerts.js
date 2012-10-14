/* *** SHOW/HIDE items *** */
// Shows or hides a block of HTML code
// SOURCE:		http://girlswhogeek.com/tutorials/2007/show-and-hide-elements-with-javascript
function showRow(id) {
	document.getElementById(id).style.display = 'table-row';
}

function showCell(id){
	document.getElementById(id).style.display = 'table-cell';
}

function showStuff(id){
	document.getElementById(id).style.display = 'block';
}
function hideStuff(id) {
	document.getElementById(id).style.display = 'none';
}
/* *** END SHOW/HIDE items *** */