@extends('Layout.pageLayout')
@section('MainPart')
    <div style="margin: 20px;">
    <h2>Register</h2>

 <!-- @if( auth()->check() )
        <li class="nav-item">
            <a class="nav-link" href="#">{{ auth()->user()->id }}</a>
        </li>
    @endif

-->
    <div class="login">
        <div class="heading">
    <form method="POST" action="/register">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="family">Family:</label>
            <input type="text" class="form-control" id="family" name="family">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="tell">Tell:</label>
            <input type="text" class="form-control" id="tell" name="tell">
        </div>

        <div class="form-group">
            <label for="bank_account">Bank Account:</label>
            <input type="text" class="form-control" id="bank_account" name="bank_account">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="hidden" class="form-control" id="company_id" name="company_id" value=0>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
        </div>
    </div>
    </div>
    @stop
@section('footer')
@stop
