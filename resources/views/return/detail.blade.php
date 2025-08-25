<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
      @if ($return[0]['rtrn_accepted'] === 1)
      <form action="/return/{{ $return[0]['rtrn_id'] }}/rejected" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" value="0" name="rtrn_accepted">
        <button type="submit" class="btn btn-warning mb-2 w-100">Reject rhis return</button>
      </form>
      @elseif ($return[0]['rtrn_accepted'] === 0)
      <form action="/return/{{ $return[0]['rtrn_id'] }}/accepted" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" value="1" name="rtrn_accepted">
        <button type="submit" class="btn btn-success mb-2 w-100">Approve this return</button>
      </form>
      @else
      <form action="/return/{{ $return[0]['rtrn_id'] }}/accepted" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" value="1" name="rtrn_accepted">
        <button type="submit" class="btn btn-success mb-2 w-100">Approve this return</button>
      </form>
      <form action="/return/{{ $return[0]['rtrn_id'] }}/rejected" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" value="0" name="rtrn_accepted">
        <button type="submit" class="btn btn-warning mb-2 w-100">Reject rhis return</button>
      </form>
      @endif
    </x-slot:side_canvas>
    <x-slot:header_layout>
      <a class="btn btn-danger w-100 mb-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$return[0]['rtrn_id']}}" >Delete this return</a>
            <div class="modal fade" id="deleteConfirmation{{$return[0]['rtrn_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$return[0]['rtrn_id']}}Label" aria-hidden="true">
              <form action="/return/{{ $return[0]['rtrn_id'] }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                @csrf
                @method('DELETE')
                <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                  <h5 class="mb-0">Delete this data?</h5> 
                  <p class="mb-0">are you sure to delete data {{$return[0]['rtrn_id']}}.</p> 
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                  <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                  <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                </div> 
              </div> 
              </form>
            </div> 
    </x-slot:header_layout>
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <div class="w-100">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Detail retrurn</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">title</th>
                  <th>value</th>
                </tr>
              </thead>
              <tbody>
                <tr class="align-middle">
                  <td>loan_id: </td>
                  <td><a href='/manage/loan/{{ $return[0]['rtrn_loan_id'] }}/detail'>{{ $return[0]['rtrn_loan_id'] }}</a></td>
                </tr>
                <tr class="align-middle">
                    <td>user: </td>
                    <td>{{ $return[0]['user']['name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                  <td>description: </td>
                  <td>{{ $return[0]['rtrn_descrription'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>note: </td>
                  <td>{{ $return[0]['rtrn_note'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Accepted: </td>
                  <td>
                    @if ($return[0]['rtrn_accepted'] === 1)
                      accepted
                    @elseif ($return[0]['rtrn_accepted'] === 0)
                    not accepted
                    @else
                    pendding
                    @endif
                  </td>
                </tr>
                <tr class="align-middle">
                  <td>Approved_at: </td>
                  <td>
                    @if ($return[0]['rtrn_approved_at'] === null)
                      not approved
                    @else
                      {{$return[0]['rtrn_approved_at']}}
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Return asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">category</th>
                  <th>codename</th>
                </tr>
              </thead>
              <tbody>
               @forelse ($assets as $asset)
               <tr class="align-middle">
                 <td>{{ $asset->asset->ast_category_id }}</td>
                 <td>{{ $asset->asset->ast_codename }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="2" class="w-100 text-center">404 | data not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        @if ($return[0]['rtrn_accepted'] === 1)
          
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Loan asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20px">#</th>
                  <th style="width: 20%">category</th>
                  <th>codename</th>
                  <th style="width: 10%">Add log</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($loaningAsset as $asset)
                @forelse ($logs as $log)
                @if ($log->ast_lg_asset_id == $asset->asset->ast_id)
                <tr class="align-middle">
                  <td>{{ $asset->asset->ast_id??'not have' }}</td>
                  <td>{{ $asset->asset->ast_category_id??'not have' }}</td>
                  <td>{{ $asset->asset->ast_codename??'not have' }}</td>
                    <td><a class="btn btn-warning" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addlog{{ $asset->asset->ast_id }}" >edit log</a>
                      <div class="modal fade" id="addlog{{ $asset->asset->ast_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addlog{{ $asset->asset->ast_id }}Label" aria-hidden="true">
                        <form action="/asset/log/{{ $asset->asset->ast_id }}/edit" method="post" class="modal-dialog modal-dialog-centered">
                          @csrf
                          @method('PUT')
                          <div class="modal-content rounded-3 shadow"> 
                            <div class="modal-body p-4 text-center"> 
                              <h5 class="mb-4">View log to asset {{ $asset->asset->ast_id }}</h5> 
                              <div class="input-group mb-3 d-block">
                                <label class="form-label">Status</label>
                                 <select name="ast_lg_status" class="form-select w-100 @error('ast_lg_status') is-invalid @enderror" required aria-label="Default select example">
                                   <option value="{{ $log->ast_lg_status }}" selected>{{ $log->ast_lg_status }}</option>
                                   <option value="good" >Good</option>
                                   <option value="damage">Damage</option>
                                   <option value="lost">Lost</option>
                                 </select>
                               </div>
                              <div class="mb-3">
                                  <label class="form-label">Note</label>
                                  <textarea class="form-control @error('ast_lg_note') is-invalid @enderror" name="ast_lg_note">{{$log->ast_lg_note}}</textarea>
                                  <input type="hidden" value="{{ $return[0]['rtrn_id'] }}" name="rtrn_id">
                                  <input type="hidden" value="{{ $log->ast_lg_id }}" name="ast_lg_id">
                              </div>
                            </div> 
                            <div class="modal-footer flex-nowrap p-0"> 
                              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                              <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
                            </div> 
                          </div> 
                        </form>
                      </div> 
                    </td>
                  </tr>
                    @else
                <tr class="align-middle">
                  <td>{{ $asset->asset->ast_id??'not have' }}</td>
                  <td>{{ $asset->asset->ast_category_id??'not have' }}</td>
                  <td>{{ $asset->asset->ast_codename??'not have' }}</td>
                    <td><a class="btn btn-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addlog{{ $asset->asset->ast_id }}" >add log</a>
                      <div class="modal fade" id="addlog{{ $asset->asset->ast_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addlog{{ $asset->asset->ast_id }}Label" aria-hidden="true">
                        <form action="/asset/log/{{ $asset->asset->ast_id }}/add" method="post" class="modal-dialog modal-dialog-centered">
                          @csrf
                          <div class="modal-content rounded-3 shadow"> 
                            <div class="modal-body p-4 text-center"> 
                              <h5 class="mb-4">Add log to asset {{ $asset->asset->ast_id }}</h5> 
                              <div class="input-group mb-3 d-block">
                                <label class="form-label">Status</label>
                                 <select name="ast_lg_status" class="form-select w-100 @error('ast_lg_status') is-invalid @enderror" required aria-label="Default select example">
                                   <option value="good" selected>Good</option>
                                   <option value="damage">Damage</option>
                                   <option value="lost">Lost</option>
                                 </select>
                               </div>
                              <div class="mb-3">
                                  <label class="form-label">Note</label>
                                  <textarea class="form-control @error('ast_lg_note') is-invalid @enderror" name="ast_lg_note"></textarea>
                                  <input type="hidden" value="{{ $return[0]['rtrn_id'] }}" name="rtrn_id">
                                  
                              </div>
                            </div> 
                            <div class="modal-footer flex-nowrap p-0"> 
                              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                              <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
                            </div> 
                          </div> 
                        </form>
                      </div> 
                    </td>
                  </tr>
                  @endif
                @empty
                <tr class="align-middle">
                  <td>{{ $asset->asset->ast_id??'not have' }}</td>
                  <td>{{ $asset->asset->ast_category_id??'not have' }}</td>
                  <td>{{ $asset->asset->ast_codename??'not have' }}</td>
                    <td><a class="btn btn-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addlog{{ $asset->asset->ast_id }}" >add log</a>
                      <div class="modal fade" id="addlog{{ $asset->asset->ast_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addlog{{ $asset->asset->ast_id }}Label" aria-hidden="true">
                        <form action="/asset/log/{{ $asset->asset->ast_id }}/add" method="post" class="modal-dialog modal-dialog-centered">
                          @csrf
                          <div class="modal-content rounded-3 shadow"> 
                            <div class="modal-body p-4 text-center"> 
                              <h5 class="mb-4">Add log to asset {{ $asset->asset->ast_id }}</h5> 
                              <div class="input-group mb-3 d-block">
                                <label class="form-label">Status</label>
                                 <select name="ast_lg_status" class="form-select w-100 @error('ast_lg_status') is-invalid @enderror" required aria-label="Default select example">
                                   <option value="good" selected>Good</option>
                                   <option value="damage">Damage</option>
                                   <option value="lost">Lost</option>
                                 </select>
                               </div>
                              <div class="mb-3">
                                  <label class="form-label">Note</label>
                                  <textarea class="form-control @error('ast_lg_note') is-invalid @enderror" name="ast_lg_note"></textarea>
                                  <input type="hidden" value="{{ $return[0]['rtrn_id'] }}" name="rtrn_id">
                              </div>
                            </div> 
                            <div class="modal-footer flex-nowrap p-0"> 
                              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                              <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
                            </div> 
                          </div> 
                        </form>
                      </div> 
                    </td>
                  </tr>
                @endforelse
                @empty
                <tr>
                  <td colspan="4" class="w-100 text-center">404 | data not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        @endif
      </div>
    </x-app-layout>