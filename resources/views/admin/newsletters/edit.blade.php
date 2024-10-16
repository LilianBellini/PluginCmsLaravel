@extends('plugincmslaravel::layouts.app')

@section('title', isset($newsletter) ? 'Modifier une newsletter' : 'Ajouter une newsletter')

@section('content')
    <div class="container mt-5">
        <h1>{{ isset($newsletter) ? 'Edit Newsletter' : 'Create Newsletter' }}</h1>
        <form action="{{ isset($newsletter) ? route('admin.newsletters.update', $newsletter->id) : route('admin.newsletters.store') }}" method="POST">
            @csrf
            @if(isset($newsletter))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ isset($newsletter) ? $newsletter->email : '' }}" required>
            </div>
            <button type="submit" class="btn btn-success">{{ isset($newsletter) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
