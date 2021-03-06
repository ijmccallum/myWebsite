<?php $iainPageTitle = 'Forms'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h3>Anti Spam</h3>


<hr />
<h3>Validation</h3>
<p>A great library: <a href="http://parsleyjs.org/">Parsley.js</a>, and it's on <a href="https://github.com/guillaumepotier/Parsley.js">github</a></p>

<hr />

<h3>Example, using parsley.js and recapcha</h3>

<form id="demo-form" data-parsley-validate method="POST" action=<?php echo $homePath . "submit.php" . '"' ?>>

  <!-- this field is just required, it would be validated on form submit -->
  <label for="fullname">Full Name * :</label>
  <input type="text" name="fullname" required />

  <!-- this required field must be an email, and validation will be run on
  field change -->
  <label for="email">Email * :</label>
  <input type="email" name="email" data-parsley-trigger="change" required />

  <!-- radio and checkbox inputs by default have to be wrapped in a parent
  elemnt (here <p>) that will have success and error classes -->
  <label for="gender">Gender *:</label>
  <p>
    M: <input type="radio" name="gender" id="genderM" value="M" required />
    F: <input type="radio" name="gender" id="genderF" value="F" />
  </p>

  <!-- here, field is not required, it won't throw any error if no checkbox
  is checked. But if checked, two at least must be checked -->
  <label for="hobbies">Hobbies (2 minimum):</label>
  <p>
    Skiing <input type="checkbox" name="hobbies" value="ski" data-parsley-mincheck="2" />
    Running <input type="checkbox" name="hobbies" value="run" />
    Eating <input type="checkbox" name="hobbies" value="eat" />
    Sleeping <input type="checkbox" name="hobbies" value="sleep" />
    Reading <input type="checkbox" name="hobbies" value="read" />
    Coding <input type="checkbox" name="hobbies" value="code" />
  <p>


  <!-- regular select input. Nothing more to add. -->
  <label for="heard">Heard us by *:</label>
  <select id="heard" required>
    <option value="">Choose..</option>
    <option value="press">Press</option>
    <option value="net">Internet</option>
    <option value="mouth">Word of mouth</option>
    <option value="other">Other..</option>
  </select>

  <!-- this optional textarea have a length validator that would be checked on keyup after 10 first characters, with a custom message only for minlength validator -->
  <label for="message">Message (20 chars min, 100 max) :</label>
  <textarea name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least a 20 caracters long comment.."></textarea>

  <input type="submit" />
</form>





<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>