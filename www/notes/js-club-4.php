<?php $iainPageTitle = 'Delphic JS club week 4: Refrence types'; $docDepth = 1;?>
<?php include '../partials/head.php';  ?>


<h2>Object</h2>

<hr />

<h2>Array</h2>

var array = new array(); //Just creates an empty array
var array2 = new array(10); //creates an array with undefined spaces.
array.length = 10; //this array is now 10 long, no matter what was there before

if (Array.isArray(variable)) { ... } //detect an array object - doesn't work in ie8 or lower!

var array = [1,2,3];
array.join("&"); // 1&2&3

<table>
	<tr>
		<td></td>
		<td>Front of array</td>
		<td>Middle of array</td>
		<td>End of array</td>
	</tr>
	<tr>
		<td>Add (and return new length)</td>
		<td>unshift('value');</td>
		<td>splice(n,0,value(s));</td>
		<td>push('value');</td>
	</tr>
	<tr>
		<td>Remove (and return removed values)</td>
		<td>shift();</td>
		<td>splice(n,n);</td>
		<td>pop();</td>
	</tr>
</table>

NOTE! If combining several arrays I think it's quicker to use concat:
var a = [1,2,3];
var b = [4,5,6];
var c = [7,8,9];
var d = a.concat(b,c);
console.log(d); // [1,2,3,4,5,6,7,8,9];
console.log(a); // [1,2,3];

SLICE

Returns a new array between n and the end or n and n2:
an array: (0) "a" (1) "b" (2) "c" (3) "d" (4) "e" (5) "f" (6) "g"
var oldArray = ["a","b","c","d","e","f","g"];
var newArray = oldArray.slice(1,4); //["b","c","d"];
console.log(newArray);
//or, we can go backwards (it doesn't loop, just startes from the other end.)
an array: (-8) "a" (-7) "b" (-6) "c" (-5) "d" (-4) "e" (-3) "f" (-2) "g" (-1)
var newArray = oldArray.slice(-2,2);
console.log(newArray);

SPLICE
//Adding multiple values into the array
var array = [1,2,3,4,5];
array.splice(2,0,"a","b");
console.log(array);

//replacing 
var array = [1,2,3,4,5];
array.splice(2,2,"a","b");
console.log(array);

//It also returns items that were removed:
var array = [1,2,3,4,5];
console.log(array.splice(2,2,"a","b"));


Reordering: 

array.reverse();
array.sort(); //defaults to ascending order by calling String() on the values - not very handy for numbers!

We can pass a comparison function to sort(customComparison);

customComparison(v1, v2){
	//if v1 should be first: return -n
	//if v2 should be first: return +n
	//if equal: return 0

	//trick:
	return v2 - v1; 
}

LOCATIONS: ie8 and below don't support (of course);
indexOf("value",index to start); //search front to back 
lastIndexOf("value",index to start); //search back to front

ITERATION- ie9+
each of these takes a function and passes it three arguments relative to the item it's iterating through: a: item , b: index ,c: the whole array, 
<ul>
	<li>every(function(a,b,c)); a 'strict' boolean check, the function we pass it must return true / false. 'every' will only return true if all are true </li>
	<li>some(function(a,b,c)); a 'loose' boolean check: again the function we pass must return true/false, 'some' will return true if only one result is true.</li>
	<li>filter(function(a,b,c)); if our function returns true, that item is added to an array that filter returns upon completion. </li>
	<li>map(function(a,b,c)); our function returns an item which is added to a new array that map returns.  eg, multiplying every item by 2.</li>
	<li>forEach(function(a,b,c)); Does not return anything!  It's the same as a for loop.</li>
</ul>

REDUCTION  - ie9+
Run through the whole array to calculate a single result.
reduce(function(a,b,c,d), value); front to back
reduceRight(function(a,b,c,d), value); back to front
the function we pass gets 4 args:
a: prev value, b:current item, c:item index , d: the array

The  prev value (a) comes from the returned value of the previous iteration.
This begins on the second item and the first item gets passed as the prev value.

<hr />

<h2>Date<small> ms from Jan 1st 1970</small></h2>
var now = new Date(); //ie9+
var then = new Date(08/20/1988); //calls Date.parse(arg); on the value, or Date.UTC(args); if args are numbers
 
Date.parse(string); //takes a date string and converts it to milliseconds
<ul>
	<li>month/date/year: 08/20/1988</li>
	<li>monthName date, year: January 20, 1999</li>
	<li><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/parse">and a few others</a> </li>
</ul>
Date.UTC(year, month(0 based), day, hours, minutes, seconds, ms );//all args numbers. Does the same as parse but with these args.

PRINTING dates:
toString(); and toLocalString(); do weird things between different browsers - annoying, guess we avoid them then!
toDateString();
toTimeString();
toUTCString();
and more, plus a whole load of get and set dates.  Google for a refrence if you're going to use it.


<hr />

<h2>RegExp <small>Regular Expressions</small></h2>

Skipping this - will do an article on it in more detail!

<hr />

<h2>Function</h2>

function fName(){ ... };
var fName = function(){ ... }; //these two are identical

Function names (fName) are just pointers to the function,
we can have multiple pointing to the same function: fName2 = fName


fName will give you a refrence to the function;
fName() will execute the function.  () means execute.

function = {
	Arguments = {//all the args that get passed in
		callee: //the function that 'owns' the arguments 
	}, 	
	caller, //points to the function within which the current function was called
	this, //refers to the scop within which the function is called (more on this later!)
	length, //the number of named args the function expects
	prototype, //holds all the default functions on objects, not enumerable (not found with forIn)
	apply(this,args), //calls the function with a manually defined scope and option for args as an array or another arguments object
	call() //same as apply, first arg is this, but all the rest get passed to the function
}

in strict mode, callee and caller result in errors?


for a call() example, paste this into the console:

window.color = "red";
var o = {color:"blue"};
function sayColor(){
	console.log(this.color);
}
sayColor();
sayColor.call(this);
sayColor.call(window);
sayColor.call(o);


bind(); does the same plus creating a new instance of the function:  ie9+

var newSayColor = sayColor.bind(o);
newSayColor(); // blue!!!

more on bind later too!

<hr />

<h2>Primitive wrapper</h2>

This is the way we can call thing like stringVar.substring(2);  
The primitive variable is wrapped in a String type object for this single line of code.
If we want the wrapper to stick around we can (although why?)
var obj = new Object("this is a string type"); //or new Boolean() / Number() / String() ...
console.log(obj instanceof String); //true

NUMBER object: gives us a few functions:

num.toFixed(2); //sets decimal places (most browsers are +/- 20)
num.toExponential(1); //e-numbers!
num.toPrecision(3); //either of the above automatically

STRING functions:
Character funcitons:
charAt(indexNum); or stringVar[indexNum] ie9+
charCodeAt(indexNum);

Add strings together (concatenate!)  Although the + operator often performs better than concat
var newString = string1.concat(string2, " and another string");

<ul>
	<li>slice(a,b) start slice at index a, end at index b<br />
	if -a or -b, count back from the right to start</li>
	<li>substr(a,b) start slice at index a, include b number of characters<br />
	if -a or -b, they are converted to 0</li>
	<li>sunbstring(a,b)<br />
	-a counts back from the right, -b is 0</li>
</ul>

finding strings:
indexOf("search string", index num to start); front to back
lastIndexOf("search string", index num to start); back to front
to get multiple values we'll have to write our own iteration

Removing the whitespace from a string with trim(); ie9+
it returns a new string.  stringVar.trim();
trimLeft(); trimRight();  check support

changing case, for everything or for language specific: 
toLowerCase(); toLocalLowerCase();
toUpperCase(); toLocalUpperCase();

searching strings:
stringVar.match(RegExp string or object); //returns strings  and index nos
stringVar.search(RegExp string or object); //returns array of indexes
stringVar.replace(RegExp string or object);, replacement string); //if arg[0] is string, only the first instance is replaced.  RegExp -g will do all
There's more to replace, but I think that should be for the RegExp article.
stringVar.split(RegExp string or object or string); //returns an array of matching strings split by the passed arg

stringVar.localeCompare(stringVar2); //determins which comes before the other alphabetically -1 is arg is after ... It's also case sensitive


<hr />

<h2>Singleton built in objects</h2>
These are things made available, like our varous types and the functions they make available.

<strong>Global</strong>
The global object is not accessible - but browsers give access through the window oject (this does more but we'll get to that later).
Another way to get it:
var global = function(){
	return this;
}

uri encoding:
<table>
	<tr>
		<td></td>
		<td>full encoding (even fancy characters)</td>
		<td>partial encoding (doesn't do things like ":")</td>
	</tr>
	<tr>
		<td>encode</td>
		<td>encodeURIComponent();</td>
		<td>encodeURI();</td>
	</tr>
	<tr>
		<td>decode</td>
		<td>decodeURIComponent();</td>
		<td>decodeURI();</td>
	</tr>
</table>

eval();  lets us pass it a string of JS to execute... interesting



<strong>Math</strong>
This object gives us access to some more interesting values.

max = Math.max(1,2,3,4,5); //5 and vice versa for min
maxInArray = Math.max.apply(Math, array);

Math.ceil(); round ints up
Math.floor(); round ints down
Math.round(); default - 0.5+ goes up

Math.random(); random value between 0 and 1
var rand = Math.floor(Math.random() * 10 + 1); //between 1 and 10
var rand = Math.floor(Math.random() * 8 + 3); //between 3 and 10

and more, and more and more!  Maybe one day I'll get into maths properly and figure out all of them here.

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
