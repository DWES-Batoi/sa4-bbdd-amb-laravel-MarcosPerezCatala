@extends('layouts.equip')
@section('title', __("Detall d'Equip"))

@section('content')
  <div class="container mx-auto p-4">
    <x-equip :nom="$equip->nom" :estadi="$equip->estadi->nom ?? __('Sense estadi')" :titols="$equip->titols"
      :escut="$equip->escut" />
  </div>
@endsection