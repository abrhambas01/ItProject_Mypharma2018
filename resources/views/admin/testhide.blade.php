
@extends('layouts.admin')


@section('content')

<div class="row">

  <div class="large-4 columns">         

    <form>
     <fieldset>
      
      <label>Pick a fruit:</label>
      <select name="Fruit" onchange="java_script_:show(this.options[this.selectedIndex].value)">
        <option value="Apple">Apple</option>
        <option value="Orange">Orange</option>
        <option value="Bananna">Bananna</option>
      </select>

      <div id="hiddenDiv" style="display:none">
        <label>Hidden 2nd Question about Oranges</label>
        <select name="Orange_question">
          <option value="Yes">Yes</option>
          <option value="No" selected>No</option>
        </select>
      </div>

      <label>Should be right beneath first question unless orange is picked:</label>
      <select name="Next Question">
        <option value="Yes">Yes</option>
        <option value="No" selected>No</option>
      </select>
    </fieldset>
  </form>
</div>
</div>





@endsection

@section('js')

<script>
 function show(aval) {
  if (aval == "Orange") {
    hiddenDiv.style.display='inline-block';
    Form.fileURL.focus();
  } 
  else{
    hiddenDiv.style.display='none';
  }
}
</script>



@endsection
