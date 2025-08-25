<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
<section class="py-5 text-center container"> 
    <div class="row py-lg-5"> 
        <div class="col-lg-6 col-md-8 mx-auto"> 
            <h1 class="fw-light">UNI-INVT</h1> 
            <p class="lead text-body-secondary">Need an asset for your work? Submit your request now and make borrowing easier and faster!.</p> 
            <p> 
                <a href="/loan/add" class="btn btn-primary my-2">Add loan</a> 
            </p> 
        </div> 
    </div> 
</section>
<div class="album py-5 bg-body-tertiary"> 
    <div class="container"> 
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> 
            @foreach ($categories as $category)
            <div class="col"> 
                <div class="card shadow-sm"> 
                    <img src="{{ asset($category->ctgy_ast_img_path??'/logo/uni_invt.png') }}" class="object-fit-cover" height="300" alt="User Image" >
                    <div class="card-body"> 
                        <h4>{{$category->ctgy_ast_name}}</h4>
                        <p class="card-text">{{$category->ctgy_ast_description}}</p> 
                        <div class="d-flex justify-content-between align-items-center"> 
                            <div class="btn-group"> 
                                <a href="/asset/category/{{ $category->ctgy_ast_id }}" class="btn btn-sm btn-outline-secondary">View</a>  
                            </div> 
                            <small class="text-body-secondary">{{$category->ctgy_ast_created_at->format('d F Y')}}</small> 
                        </div> 
                    </div> 
                </div> 
            </div>
            @endforeach
        </div> 
    </div> 
</div> 
</x-app-layout>