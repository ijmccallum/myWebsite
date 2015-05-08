<?php $iainPageTitle = 'Delphic JS club week 1: Data Types and Operators'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>So, at work (Delphic Digital) the guys set up a weekly lunch club on JS.  
The plan is to work through the language from start to finish, clarify anything that needs clarifying,
standardise any quirks in our knowledge, get everyone up to scratch and beyond.  As is my habit with 
things, I'll keep a note of the things we go through in an extra attempt to get everything to stick in my mind.</p>

<hr />

<h2>Week 1: Data Types and Operators <small>Also, the history of JS but I'll leave that out from these notes</small></h2>

<br />

<h4>Data types</h4>
<p>5 simple data types: <code>Undefined</code> <code>Null</code> <code>Boolean</code> <code>Number</code> <code>String</code></p>
<p>1 complex data type: <code>Object</code> (this is my favourite one)</p>
<p>1 outsider: <code>function</code> - they're technically considered an object, but they're special.</p>

<br />

<h4><code>typeof</code> operator</h4>

<table class="table table-bordered table-condensed">
	<tr>
		<th>Data Type</th>
		<th><code>typeof</code> return value</th>
	</tr>
	<tr>
		<td></td>
		<td>"undefined" (as in, the variable hasn't even been declared yet)</td>
	</tr>
	<tr>
		<td>Undefined</td>
		<td>"undefined" (a declared variable but no value assigned)</td>
	</tr>
	<tr>
		<td>Null</td>
		<td>"object" (it's considered an empty object)</td>
	</tr>
	<tr>
		<td>Boolean</td>
		<td>"boolean"</td>
	</tr>
	<tr>
		<td>Number</td>
		<td>"number"</td>
	</tr>
	<tr>
		<td>String</td>
		<td>"string"</td>
	</tr>
	<tr>
		<td>Object</td>
		<td>"object"</td>
	</tr>
	<tr>
		<td>Function</td>
		<td>"function"</td>
	</tr>
</table>

<br />

<h4>Undefined <small>provided in ECMA-262 to differentiate between an empty object and an uninitialized variable.</small></h4>
<ul>
	<li><code>var variableName;</code> variableName is undefined</li>
	<li><code>var variableName = undefined;</code> same as above (but don't do this, it's silly).</li>
	<li>It's best to assign variables a value when declaring them, so when you do get "undefined" from <code>typeof</code> you know it's because
	they've not been declared as opposed to not initialized.</li>
</ul>

<br />

<i>NEEDS MORE</i>
<h4>Null <small>it's related to undefined so we've got some equlity fun to play with here!</small></h4>
<ul>
	<li><code>null == undefined</code> true (== converts the operands for comparison)</li>
	<li><code>var car = null;</code></li>
</ul>
<br />

<i>NEEDS MORE</i>
<h4>Boolean <small>True or false?</small></h4>
<ul>
	<li>Not numeric values: true does not equal 1, false does not equal 0.</li>
	<li>Every data type has a boolean equivolent: <code>Boolean(variableName)</code> - <code>if()</code> uses this casting function.</li>
</ul>
<br />

<h4>Number <small>Integer, Floating-point, Octal, Hexadecimal, but I pretty much always use integers</small></h4>
<ul>
	<li>Integer: Simple whole number</li>
	<li>Floating-point: Numbers with a decimal point. 
		<ul>
			<li>They ues up double the memory (compared to an integer).  </li>
			<li>They also suffer from small rounding errors so are inacurate for arithmatic.</li>
			<li>Very large or small floating points can be simplified with e-notation:
				<ul>
					<li>300000000 = 3e8</li>
					<li>0.000003 = 3e-6</li>
				</ul>
			</li>
		</ul>
	</li>
	<li>Octal: base 8
		<ul>
			<li>070 = 56</li>
		</ul>
	</li>
	<li>Hexadecimal: base 16
		<ul>
			<li>0xA = 10</li>
			<li>0x1f = 31</li>
		</ul>
	</li>
</ul>
<p>There is a max an min number possible in JavaScript, anything above is <code>Infinity</code> and anything below is <code>-Infinity</code>.  
If you're concerned with these numbers though, wow.</p>

<br />

<h4>NaN <small>Not a Number: so we can do crazy maths without crashing</small></h4>
<ul>
	<li>Any formula that fails (like number / 0) comes out as NaN</li>
	<li>Any operation with NaN equals NaN</li>
	<li><code>NaN == NaN</code> is false so we have isNaN()
		<ul>
			<li>isNaN(NaN) true</li>
			<li>isNaN(100) false</li>
			<li>isNaN("1") false</li>
			<li>isNaN("a") true</li>
			<li>isNaN(true) false</li>
		</ul>
		It's like we're a child asking it "will this break my arithmatic?", and it's like a patient parent telling us that, yes - using strings in a multiplication is going to break our arithmatic.
	</li>
</ul>

<br />

<h4>Number conversions <small>Make anything a number!</small></h4>
We have three functions at our disposal to convert strings into numbers.

<p><strong><code>Number()</code></strong>: takes any object and attempts to cast it.</p>
<p><strong><code>parseInt()</code></strong>: takes a string and attempts to return an integer</p>
<p><strong><code>parseFloat()</code></strong>: takes a string and attempts to return a float (but will return an integer if no decimal point.)</p>

<table class="table table-bordered table-condensed">
	<tr>
		<th><code>Number()</code></th>
		<th><code>parseInt()</code></th>
		<th><code>parseFloat()</code></th>
	</tr>
	<tr>
		<td>"Hi" = NaN</td>
		<td>"Hi" = NaN</td>
		<td>"Hi" = NaN</td>
	</tr>
	<tr>
		<td>"" = 0</td>
		<td>"" = NaN</td>
		<td>"" = NaN</td>
	</tr>
	<tr>
		<td>"0011" = 11</td>
		<td>"0011" = 11</td>
		<td>"0011" = 11</td>
	</tr>
	<tr>
		<td>true = 1</td>
		<td>true = </td>
		<td>true = </td>
	</tr>
	<tr>
		<td>12hi = NaN</td>
		<td>12hi = 12</td>
		<td>12hi = 12</td>
	</tr>
	<tr>
		<td>22.5 = 22?</td>
		<td>22.5 = 22</td>
		<td>22.5 = 22.5</td>
	</tr>
</table>

<p><code>ParseInt()</code> allows us to pass in a second argument to indicate the radix number we'd like to use.</p>
<ul>
	<li><code>ParseInt("10", 10);</code> is the most common as we usually work in decimal.</li>
</ul>

<br />

<h4>Strings</h4>

<p>Double or single quotes work, must be paired.</p>
<p>Character literals:
<code>\n</code>: new line, 
<code>\t</code>: tab
<code>\b</code>: backspace
<code>\r</code>: carriage return
<code>\f</code>: form feed ?
<code>\\</code>: backslash
<code>\'</code>: single quote (within single quotes)
<code>\"</code>: double quote (the same)
<code>\xnn</code>: hex code char
<code>\unnn</code>: unicode</p>
<p>Every object has a toString method (even strings).  Usually just objetc.toString(); but we can include the radix number when calling it on numbers:
<pre><code>var num = 10;
num.toString(); //10
num.toString(2); //1010
num.toString(8); //12
num.toString(10); //10
num.toString(16); //a</code></pre>
</p>
<p>We can also call <code>String()</code> which will call toString unless the value is null or undefined (which cause an error with toString). In their cases "null" and "undefined" are returned.</p>

<br />

<h4>Objects</h4>
Everything in JS is an object, therefor everything in JS has the following properties:
<code>var o = new Object();</code>
<ul>
	<li><code>o.hasOwnProperty(property);</code> checks only this instance, not the prototype</li>
	<li><code>o.isPrototypeOf(object);</code> </li>
	<li><code>o.propertyIsEnumerable(property);</code> can we for-in through it.</li>
	<li><code>o.toLocalString();</code>...need more on why local for this one</li>
	<li><code>o.toString();</code> returns a string of the object</li>
	<li><code>o.valueOf();</code> string/num/bool usually the same as toString()</li>
</ul>

<br />

<p>Some extras:</p>
<ul>
	<li>Identifiers are <strong>case sensitive</strong> (vars, function names...)</li>
	<li>Strick mode: <code>"use strict";</code> fixes ECMAscript 3 weirdness, use it at the top of the script. (or in individual functions at the top)</li>
</ul>

<hr >

<h4>Operators</h4>

<h4>increment/decrement</h4>

<table class="table table-bordered table-condensed">
	<tr>
		<td></td>
		<td>prefixed: variable is changed then the line of code it's in is evaluated.</td>
		<td>postfixed: line of code is evaluated, then the variable is changed.</td>
	</tr>
	<tr>
		<td>increment</td>
		<td>++variable</td>
		<td>variable++</td>
	</tr>
	<tr>
		<td>decrement</td>
		<td>--variable</td>
		<td>variable--</td>
	</tr>
</table>
<p>These can be applied to any type of data:</p>
<ul>
	<li>String version of a number: translated into a number and operated upon</li>
	<li>String, non valid number: changed to NaN</li>
	<li>Boolean, converted no number and operated upon</li>
	<li>Object - I can't think why you'd do this?</li>
</ul>

<br />

<h4>Bitwise operators</h4>
<p>Need to look up examples where there are used</p>

<br />

<h4>Boolean operators</h4>

<p>NOT: <code>!data</code>, interesting point here, you can use <code>!!</code> to cast anything into a boolean value</p>
<p>AND: <code>data && data</code>, both need to be true, if the first s false then it short circuts.</p>
<p>OR: <code>data || data</code>, only one needs to be true, if the first is true it short circuts<br />
Also handy for assigning values: <code>var = preferred || backup;</code></p>

<br />

<h4>*, /, %, +, -</h4>

<p>All do as expected to do.  If used with non-numeric data then casting happens.</p>

<br />

<h4>Equality operators</h4>

<ul>
	<li><code>==</code> / <code>!=</code>: equal/not-equal to after conversion</li>
	<li><code>===</code> / <code>!==</code>: equal/not-equal to identically</li>
</ul>

<hr />

<h2>Week 2: Data Types and Operators</h2>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
