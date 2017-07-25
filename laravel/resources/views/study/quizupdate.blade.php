@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
         <div id='ground'>
                <h1>정답</h1>
       <table border="2px">
       <tr>
              <td>1번</td><td>2번</td><td>3번</td><td>4번</td>
       </tr>       
              
        <tr>
            <td id='answer1'>
              <select>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
              </select>
              </td> 
                    
              <td id='answer2'>
              <select>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>   
              </select>
              </td> 
              
              <td id='answer3'>
              <select>        
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>    
              </select>
              </td> 
              <td id='answer4'> 
              <select>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>  
              </select>
              </td>
        </tr>
        
       </table>         
        <input type="text" class="form-control"  placeholder="정답을 순서대로 입력하세요 최대 4자 " maxlength="4">     
                
        <h1>예시</h1>         
        <table border="2px">
       <tr>
              <td>1번</td><td>2번</td><td>3번</td><td>4번</td>
       </tr>       
              
        <tr>
            <td id='exam1'> </td> <td id='exam2'> </td> <td id='exam3'> </td> <td id='exam4'> </td>
        </tr>
        
        
       </table>
       <input type="text" class="form-control"  placeholder="예시를 순서대로 입력하세요 최대 4자  " maxlength="4">    
         </div>
  </div>
  <div class="col-md-4"></div>

</div>

</div>

<script>
var examples=new Array();
var answers=new Array();

getexamples('{{$example->examples}}');
getanswers('{{$example->answers}}');


function getexamples(string){
    examples=string.split(',');
}
function getanswers(string){
    answers=string.split(',');       
}

    
</script>
@endsection  