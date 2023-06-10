@extends('layouts.master')
@section('content')

     <!-- Start Page title and tab -->
     <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="header-action">
                    <h1 class="page-title">School</h1>
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">My Result Room</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Score Sheet</li>
                    </ol>
                </div>
                <ul class="nav nav-tabs page-header-tab">
                    @if (\Session::has('schoolclassid') || \Session::has('subjectclassid') || \Session::has('stafid') || \Session::has('termid') || \Session::has('sessionid'))
                        <li class="nav-item"> <a href='/subjectscoresheet/{{ \Session::get('schoolclassid') }}/{{ \Session::get('subjectclassid') }}/{{ \Session::get('staffid') }}/{{ \Session::get('termid')}}/{{ \Session::get('sessionid') }}'
                            class="btn btn-outline-success" data-toggle="tooltip" > < Back</a> </li>

                        @else
                        <li class="nav-item"> <a href="{{ route('myresultroom.index') }}" class="btn btn-outline-success" data-toggle="tooltip" > < Back</a> </li>
                        @endif


                </ul>
            </div>
        </div>

        @if (\Session::has('status'))
           <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p>{{ \Session::get('status') }}</p>
            </div>
        @endif
            @if (\Session::has('success'))
           <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"></button>
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif

    </div>

    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane active" id="edit-arm">
                    <div class="card">
                        <div class="card-header">
                            <?php foreach($broadsheets as $b){
                                $b->bid;
                                $b->subjectcode;
                                $b->subject;
                                $b->term;
                                $b->session;

                            } ?>
                            <h3 class="card-title">{{ $b->subject; }} {{  $b->subjectcode }} score edit for {{ $b->term }} {{ $b->session }} session</h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h5> </h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>

                        <div class="card-body">

                            {!! Form::model($broadsheets, ['route' => ['subjectscoresheet.update', $b->bid], 'method'=>'PATCH','class'=>'form-horizontal form-stripe','onSubmit'=>'return validateForm();']) !!}
                            @csrf
                            <div class="row clearfix">

                                <div class="col-md-2 col-sm-3">
                                    <div class="form-group">

                                        <?php $sn = 1; ?>

                                            @foreach ($broadsheets as $b)


                                            <?php

                                            if ($b->picture == NULL || $b->picture =="" || !isset($b->picture) ){

                                                  // $cimage =  $imageclass;
                                                   $image =  'unnamed.png';
                                            }else {

                                               $image =  $b->picture;
                                            }

                                            ?>
                                            <td><img  class = "avatar avatar-xxl" src="{{ asset('images/studentpics/'.$image) }}"/></td>
                                          @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="form-group">

                                        <label>CA 1 ({{ $b->ca1 }}%)</label>
                                        <input type="text" class="form-control" id="ca1" name="ca1" min="0" step="any" onkeyup="sum();" value="{{ $ca1 }}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="form-group">
                                        <label>CA 2 ({{ $b->ca2 }}%)</label>
                                        <input type="text" class="form-control" id="ca2" name="ca2" min="0" step="any" onkeyup="sum();" value="{{ $ca2 }}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="form-group">
                                        <label>EXAM ({{ $b->exam }}%)</label>
                                        <input type="text" class="form-control" id="exam" name="exam"min="0" step="any"  onkeyup="sum();" value="{{ $exam}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="form-group">
                                        <label>TOTAL</label>
                                        <input type="text" class="form-control" id="total" name="total" min="0" step="any" onkeyup="sum();" value="{{ $total }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-2">
                                    <div class="form-group">
                                        <label>GRADE</label>
                                        <input type="text" class="form-control" id="grade" name="grade" onkeyup="sum();" value="{{ $grade }}" readonly>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="remark" name="remark" onkeyup="sum();" value="{{ $remark}}" readonly>
                                <div class="col-md-1 col-sm-2">
                                    <div class="form-group">
                                        <label>ENTER</label>
                                        <button type="submit" class="btn btn-primary" >Submit</button>
                                    </div>
                                </div>
                                <div class="col-sm-12">

                                  <h3 class="card-title"> {{ $b->title }} {{ $b->fname}}   {{ $b->lname}} ({{ $b->admissionno }})</h3><h5>{{ $b->schoolclass }} {{ $b->arm }}</h5>
                                    <hr>


                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
<script>

function validateForm(){

var grade = "";
var txtFirsttextValue= 0;
var txtSecondtextValue = 0;
var txtExamtextValue = 0;
var result = 0;
var total = 0;

            var txtFirsttextValue = document.getElementById('ca1').value;
            var txtSecondtextValue = document.getElementById('ca2').value;
            var txtExamtextValue = document.getElementById('exam').value;
            if(txtFirsttextValue > <?= $b->ca1 ?> || txtFirsttextValue == ""){
                alert('First CA  scores cannot be more than'+ <?= $b->ca1 ?> +' marks or empty');
                return false;
            }
            if(isNaN(txtFirsttextValue)){
                alert("First CA  is not a digit please");
                return false;
            }
            if(txtSecondtextValue > <?= $b->ca2 ?> || txtSecondtextValue == ""){
                alert('Second CA scores cannot be more than '+ <?= $b->ca2 ?> +' marks or empty');
                return false;
            }
            if(isNaN(txtSecondtextValue) ){
                alert("Second CA is not a digit please");
                return false;
            }

            if(txtExamtextValue > <?= $b->exam ?> || txtExamtextValue == "" ){
                alert('Exam scores cannot be more than '+ <?= $b->exam ?> +' marks or empty');
                return false;
            }
            if(isNaN(txtExamtextValue)){
                alert("Exam score is not a digit please");
                return false;
            }

}
function sum() {

var grade = "";
var txtFirsttextValue= 0;
var txtSecondtextValue = 0;
var txtExamtextValue = 0;
var result = 0;
var total = 0;

            var txtFirsttextValue = document.getElementById('ca1').value;
            var txtSecondtextValue = document.getElementById('ca2').value;
            var txtExamtextValue = document.getElementById('exam').value;
            if(txtFirsttextValue > <?= $b->ca1 ?> || txtFirsttextValue == ""){
                alert('First CA  scores cannot be more than ' + <?= $b->ca1 ?> +' marks or empty');
                return false;
            }
            if(isNaN(txtFirsttextValue)){
                alert("First CA  is not a digit please");
                return false;
            }
            if(txtSecondtextValue > <?= $b->ca2 ?> || txtSecondtextValue == ""){
                alert('Second CA scores cannot be more than '+ <?= $b->ca2 ?> +' marks or empty');
                return false;
            }
            if(isNaN(txtSecondtextValue) ){
                alert("Second CA is not a digit please");
                return false;
            }

            if(txtExamtextValue > <?= $b->exam ?> || txtExamtextValue == "" ){
                alert('Exam scores cannot be more than '+ <?= $b->exam ?> +' marks or empty');
                return false;
            }
            if(isNaN(txtExamtextValue)){
                alert("Exam score is not a digit please");
                return false;
            }

            var result = parseFloat(txtFirsttextValue) +
                         parseFloat(txtSecondtextValue) +
                         parseFloat(txtExamtextValue) ;
            total = parseFloat(result);

            if (!isNaN(result)) {
                //document.getElementById('total').value = txtFirsttextValue;
                document.getElementById('total').value = total;
               // total = document.getElementById('total').value
                if (total >=70){
                grade = "A";
                document.getElementById('grade').style.color = "green";
                document.getElementById('grade').value = grade;
                document.getElementById('remark').value = "EXCELLENT";
                }
                else if(total >= 60 && total <= 69){
                grade = "B";
                document.getElementById('grade').style.color = "green";
                document.getElementById('grade').value = grade;
                document.getElementById('remark').value = "VERY GOOD";
                }else if(total >= 40 && total <= 59){
                    grade = "C";
                    document.getElementById('grade').style.color = "blue";
                    document.getElementById('grade').value = grade;
                    document.getElementById('remark').value = "GOOD";
                } if(total >= 30 && total <=39){
                   document.getElementById('grade').style.color = "red";
                    grade = "D";
                    document.getElementById('grade').value = grade;
                    document.getElementById('remark').value = "FAILY GOOD";
                } if(total <= 29){
                    document.getElementById('grade').style.color = "red";
                    grade = "F";
                    document.getElementById('grade').value = grade;
                    document.getElementById('remark').value = "POOR";
                }

            }
  }

      </script>
    @endsection
