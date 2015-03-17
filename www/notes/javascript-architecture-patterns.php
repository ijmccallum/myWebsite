<?php $iainPageTitle = 'Architectural Javascript Patterns: MV*'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

tada!
<table class="table table-bordered table-condensed">
	<tr>
		<td>MVC</td>
		<td>MVP</td>
		<td>MVVM</td>
	</tr>
</table>

<hr />

<h2>MVC</h2>

<h4>Model</h4>
Concerned only with the data.
Is often observed by 1 or more views.
Often collected into groups (eg a photo gallery where photo data = modal)

<h4>View</h4>
Concerned with visual representation.
Typically observes a modal for updates.
Referred to as 'dumb'.
The presentation Layer.
This is the part the user interacts with.

<h4>Controller</h4>
Handles actions from the view.
Manipulates data in the Model.

<hr />

<h2>MVP</h2>

Model, View, Presentor.  
Presentor is the important one here (after running through MVC).
It's 


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
