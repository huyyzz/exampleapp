@extends('admin.layout')

@section('content')
<div class="push-top">
    @if(session()->get('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->get('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session()->get('error') }}
        </div>
    @endif
    
    <table class="table push-top">
        <thead>
            <tr class="table-primary">
                <td><i class="fas fa-hashtag"></i> ID</td>
                <td><i class="fas fa-tag"></i> Tên danh mục</td>
                <td><i class="fas fa-calendar-plus"></i> Tạo lúc</td>
                <td><i class="fas fa-calendar-edit"></i> Cập nhật lúc</td>
                <td class="text-center">
                    <a href="{{ route('categories.create')}}" class="btn btn-warning btn-lg">Thêm danh mục</a>
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr data-id="{{$category->id}}">
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at->format('d/m/Y H:i')}}</td>
                    <td>{{$category->updated_at->format('d/m/Y H:i')}}</td>
                    <td class="btnContainer">
                        <form action="{{ route('categories.edit', $category->id)}}" method="get" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-primary blockBtn">Cập nhật</button>
                        </form>

                        <form action="{{ route('categories.show', $category->id)}}" method="get" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-primary blockBtn">Chi tiết</button>
                        </form>

                        <form action="{{ route('categories.destroy', $category->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger blockBtn" type="submit" 
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection