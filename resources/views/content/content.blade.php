@extends('master')
@section('content')

@if(Auth::check())
  @if(Auth::user()->idrol ==1)
    <template v-if="menu==0">
      <category></category>
    </template>

    <template v-if="menu==1">
      <user></user>
    </template>

    <template v-if="menu==12">
      <rol></rol>
    </template>

    <template v-if="menu==13">
      <forwarder></forwarder>
    </template>

    <template v-if="menu==14">
      <billingcompany></billingcompany>
    </template>

    <template v-if="menu==15">
      <istatus></istatus>
    </template>

    <template v-if="menu==16">
      <service></service>
    </template>

    <!--<template v-if="menu==17">
      <cost></cost>
    </template>-->

    <template v-if="menu==2">
      <customer></customer>
    </template>

    <template v-if="menu==3">
      <supplier></supplier>
    </template>

    <template v-if="menu==4">
      <h1>Contenido 4</h1>
    </template>


    <template v-if="menu==6">
      <inspector></inspector>
    </template>

    <template v-if="menu==7">
      <arrange></arrange>
    </template>

    <template v-if="menu==8">
      <assigned></assigned>
    </template>

    <template v-if="menu==9">
      <preaction></preaction>
    </template>

    <template v-if="menu==10">
      <action></action>
    </template>

    <template v-if="menu==11">
      <monitor></monitor>
    </template>

    <template v-if="menu==5">
      <score></score>
    </template>

    <template v-if="menu==18">
      <scoreqci></scoreqci>
    </template>

    <template v-if="menu==19">
      <scoresfa></scoresfa>
    </template>

    <template v-if="menu==20">
      <reporting></reporting>
    </template>

    <template v-if="menu==21">
      <reportingqci></reportingqci>
    </template>

    <template v-if="menu==22">
      <reportingsfa></reportingsfa>
    </template>

    <template v-if="menu==23">
      <servicenew></servicenew>
    </template>

    <template v-if="menu==24">
      <servicefollowup></servicefollowup>
    </template>

    <template v-if="menu==25">
      <prescore></prescore>
    </template>

    <template v-if="menu==26">
      <prescoreqci></prescoreqci>
    </template>

    <template v-if="menu==27">
      <prescoresfa></prescoresfa>
    </template>

    <template v-if="menu==28">
      <complete></complete>
    </template>

    <template v-if="menu==29">
      <cancel></cancel>
    </template>

    <template v-if="menu==30">
      <invoice></invoice>
    </template>
  @elseif(Auth::user()->idrol ==2)
    <template v-if="menu==16">
      <service></service>
    </template>

    <template v-if="menu==17">
      <cost></cost>
    </template>
    <template v-if="menu==2">
      <customer></customer>
    </template>

    <template v-if="menu==3">
      <supplier></supplier>
    </template>

    <template v-if="menu==30">
      <invoice></invoice>
    </template>
  @elseif(Auth::user()->idrol ==3)
  <template v-if="menu==6">
    <inspector></inspector>
  </template>

  <template v-if="menu==7">
    <arrange></arrange>
  </template>

  <template v-if="menu==8">
    <assigned></assigned>
  </template>

  <template v-if="menu==5">
    <score></score>
  </template>

  <template v-if="menu==18">
    <scoreqci></scoreqci>
  </template>

  <template v-if="menu==19">
    <scoresfa></scoresfa>
  </template>

  @elseif(Auth::user()->idrol ==4)
  <template v-if="menu==9">
    <preaction></preaction>
  </template>

  <template v-if="menu==10">
    <action></action>
  </template>
  @elseif(Auth::user()->idrol ==5)
  <template v-if="menu==23">
    <servicenew></servicenew>
  </template>

  <template v-if="menu==24">
    <servicefollowup></servicefollowup>
  </template>

  <template v-if="menu==25">
    <prescore></prescore>
  </template>

  <template v-if="menu==26">
    <prescoreqci></prescoreqci>
  </template>

  <template v-if="menu==27">
    <prescoresfa></prescoresfa>
  </template>

  <template v-if="menu==28">
    <complete></complete>
  </template>
  @elseif(Auth::user()->idrol ==6)
    <template v-if="menu==10">
      <h1>Contenido 10</h1>
    </template>
  @elseif(Auth::user()->idrol ==7)
    <template v-if="menu==10">
      <h1>Contenido 10</h1>
    </template>
  @elseif(Auth::user()->idrol ==8)
  <template v-if="menu==7">
    <arrange></arrange>
  </template>

  <template v-if="menu==8">
    <assigned></assigned>
  </template>
  <template v-if="menu==11">
    <monitor></monitor>
  </template>
  @elseif(Auth::user()->idrol ==9)
  <template v-if="menu==20">
    <reporting></reporting>
  </template>

  <template v-if="menu==21">
    <reportingqci></reportingqci>
  </template>

  <template v-if="menu==22">
    <reportingsfa></reportingsfa>
  </template>
  @endif
@endif
@endsection
