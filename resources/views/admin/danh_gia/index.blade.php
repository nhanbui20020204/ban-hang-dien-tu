@extends('share_admin.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Danh Sách Đánh Giá
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="input-group">

                                {{-- <input v-model="key_search" v-on:keyup.enter="timKiem()" v-on:blur="timKiem()" type="text"
                                    class="form-control" placeholder="Nhập vào thông tin cần tìm" aria-label="Amount"> --}}

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="danh_sach">
                                <thead>
                                    <tr>
                                        <th class="text-center text-nowrap">#</th>
                                        <th class="text-center text-nowrap">Customer</th>
                                        <th class="text-center text-nowrap">Tên Sản Phẩm</th>
                                        {{-- <th class="text-center text-nowrap">Tên Sản Phẩm</th> --}}
                                        <th class="text-center text-nowrap">Nội Dung</th>
                                        <th class="text-center text-nowrap">Sao</th>
                                        {{-- <th class="text-center text-nowrap">Tình Trạng</th> --}}
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list">
                                        <tr>
                                            <th class="text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap text-center">@{{ value.ho }} @{{ value.dem }} @{{ value.ten }} </td>
                                            <td class="text-nowrap text-center" >@{{ value.ten_san_pham }}</td>
                                            {{-- <td class="text-nowrap">@{{ value.ten_san_pham }}</td> --}}
                                            <td class="align-middle text-nowrap text-center">
                                                <i v-on:click="chi_tiet = value.noi_dung" data-bs-toggle="modal" data-bs-target="#chiTietModal" class="fa-2x fa-solid fa-circle-info text-info" ></i>
                                            </td>
                                            <td class="text-nowrap text-center">@{{ value.sao }}</td>
                                            {{-- <td class="text-nowrap text-center">
                                                <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 0"
                                                    class="btn btn-warning">Tạm Tắt</button>
                                                <button v-on:click="changeStatus(value)" v-else
                                                    class="btn btn-success">Hiển
                                                    Thị</button>
                                            </td> --}}
                                            <td class="text-center align-middle text-nowrap">
                                                <i data-bs-toggle="modal"
                                                    data-bs-target="#delModal"v-on:click="del = Object.assign({}, value)"
                                                    class="fa-solid fa-trash fa-2x text-danger"></i>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div class="modal fade" id="chiTietModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Nội Dung</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @{{ chi_tiet}}
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Đánh Giá</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn chắc chắn muốn xóa đánh giá khỏi danh
                                        sách này không ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button v-on:click="xoaBaiViet()" type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Xác Nhận Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            new Vue({
                el: '#app',
                data: {
                    list        : [],
                    del         : {},
                    edit        : {},
                    chi_tiet    : '',
                    noi_dung    : '',
                },
                created() {
                    this.loadDanhGia();
                },
                methods: {
                    loadDanhGia() {
                        axios
                            .get('{{ Route('dataDanhGiaAdmin') }}')
                            .then((res) => {
                                this.list = res.data.data;
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0], 'Error');
                                });
                            });
                    },


                    xoaBaiViet() {
                        axios
                            .post('{{ Route('deleteAdmin') }}', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    this.loadDanhGia();
                                    toastr.success(res.data.message);
                                    $('#delModal').modal('hide');
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    // changeStatus() {
                    //     axios
                    //         .post('{{ Route('statusDanhGiaAdmin') }}', )
                    //         .then((res) => {
                    //             toastr.warning("Đã đổi trạng thái", "Thành Công!")
                    //         });
                    // },
                },
            });
        });
    </script>
@endsection
