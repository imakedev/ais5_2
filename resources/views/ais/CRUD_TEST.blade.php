@extends('layouts.main')

@section('page_title','CRUD')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
        <!-- Content Start-->
        
        
        <script src='/Controller/cCRUD.js'></script>
        
         @if(session()->has('message'))
                 {{ session()->get('message') }}
         @endif
        <table width='500' style='background:white;'>
            <thead>
                <th><b>Name</b></th>
                <th><b>Age</b></th>
                <th><b>Action</b></th>
            </tr>
            </thead>
            <tbody id='bodyMember'>
            <tr>
                <td>DDD</td>
                <td>AAA</td>
                <td>
                    <a href='#'>Del</a>
                    <a href='#'>Edit</a>
                </td>
            </tr>
            </tbody>
            
        </table>
        <br>
        <table>
            <tr>
                <td>
                    Name
                </td>
                <td>
                    <input id='name' type='name'>
                </td>
            </tr>
            <tr>
                <td>
                    age
                </td>
                <td>
                    <input id='age' type='age'>
                </td>
            </tr>
            <tr>   
                <td></td> 
                <td>
                  
                     <input type='hidden' id='action' name='action' value='add'>
                     <input type='hidden' id='id' name='id' value=''>
                    <input type='button' id='btnSubmit' name='btnSubmit' value='Add'>
                    <input type='reset' id='btnReset' name='btnReset' value='Cancel'>
                </td>
            </tr>
        </table>
        
       
        <!-- Content End-->
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop