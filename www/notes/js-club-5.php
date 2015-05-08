<?php $iainPageTitle = 'Delphic JS club week 5: Object Oriented rogramming'; $docDepth = 1;?>
<?php include '../partials/head.php';  ?>


Objects and their internal properties [[enumerable]]... hmm!

<h3>Data properties</h3>

probably won't ever need these, but good to know!

[[Configurable]] - boolean, true, indicates if property can be edited
[[Enumerable]] - boolean, true, if property can be found in for in loop
[[Writable]] - boolean, true, properties value can be changed
[[value]] - the actual data

We can set these properties with:

var obj = {};
Object.defineProperty(obj, "name", {
	writable: false, //can't change it
	configurable: false, //can't delete it from obj (nor can this be reset)
	value: "word!"
});
obj.name = "no word";
console.log(obj.name);  //word!


<h3>accessor properties</h3>
Similar to above but without an actual value.

[[Configurable]]
[[Enumerable]]
[[Get]] - a function to run when we ask for the value
[[Set]] - a funciton to run when we set the value

these can be set in the same way as above with the defineProperty() method, but we also have the option to define data and accessor properties as follows:

var obj = {};
Object.defineProperties(obj, {
	stringVar: {
		value: "name"
	},
	_intVar: {
		value: 1
	},
	intVar: {
		get: function(){
			return this._intVar
		},
		set: function(newIntVar){
			//do something
			this._intVar = newIntVar;
		}
	},

});

<h3>inspecting these properties</h3>

var properties = Object.getOwnPropertyDescriptor(objectName, "propertyName");
properties.value
properties.configurable
properties.enumerable ... 

<hr />

Usnig the constructor pattern we get a refrence back to the type, this is because of the new keyword

function Thing(name){
	this.name = name;
}
var theThing = new Thing('name');
console.log(theThing.constructor == Thing); //true
console.log(theThing instanceof Thing); //true
console.log(Thing instanceof Object); //true
console.log(theThing instanceof Object); //true

<hr />

<h3>Prototypes!</h3>
continuing from above

Thing.prototype.sayName = function(){
	console.log(this.name);
}

Applying functions to the prototype object means all instances share the same function rather than creating a new one for each.


So, we have the constructor function.  
This has a link to it's prototype.  
Any instances also have a link to the prototype.  
The prototype has a link to the constructor.
Everything funnels to the prototype which then directs to the constructor.

When calling a property on an instance, a search begins.  
1 - does this instance have that property.  
2 - does the prototype have that property

So any properties on the instance 'shadow' those on the prototype.
we can remove them onl with the delete operator:
delete object.propertyName;

We can also check if a property is only on an instance with 
objectName.hasOwnProperty('propertyName');


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
