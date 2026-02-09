@extends('pdf')
@section('title', strtoupper('bulletin '.$cutting->cutting->libelle.' - '.$classe->libelle))
@section('year', $classe->schoolYear->libelle)