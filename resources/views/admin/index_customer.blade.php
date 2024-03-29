@extends('share_admin.master')
@section('noi_dung')
    <div id="app" class="row">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary round waves-effect" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Thêm Mới Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Họ</label>
                                    <input v-model="add.ho" type="text" class="form-control"
                                        placeholder="Nhập họ đệm">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Đệm</label>
                                    <input v-model="add.dem" type="text" class="form-control"
                                        placeholder="Nhập họ đệm">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Tên</label>
                                    <input v-model="add.ten" type="text" class="form-control" placeholder="Nhập tên">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Số Điện Thoại</label>
                                    <input v-model="add.so_dien_thoai" type="tel" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Email</label>
                                    <input v-on:blur="checkEmail()" v-model="add.email" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Mật Khẩu</label>
                                    <input v-model="add.password" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Địa Chỉ</label>
                                    <input v-model="add.dia_chi" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Ngày Sinh</label>
                                    <input v-model="add.ngay_sinh" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="add.status" class="form-control">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Tạm tắt</option>
                                        <option value="2">Bị khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="themMoi" v-on:click="themMoi()" class="btn btn-primary"
                            data-bs-dismiss="modal">Thêm Mới Customer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Danh Sách Customer
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="input-group">
                                <button class="btn btn-outline-primary waves-effect" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                                <input v-model="key_search" v-on:keyup.enter="timKiem()" type="text"
                                    class="form-control" placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
                                <button v-on:click="timKiem()" class="btn btn-outline-primary waves-effect"
                                    type="button">Search !</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="danh_sach">
                                <thead>
                                    <tr>
                                        <th class="text-center text-nowrap">#</th>
                                        <th class="text-center text-nowrap">Họ đệm</th>
                                        <th class="text-center text-nowrap">Tên</th>
                                        <th class="text-center text-nowrap">Số Điện Thoại</th>
                                        <th class="text-center text-nowrap">Địa Chỉ</th>
                                        <th class="text-center text-nowrap">Email</th>
                                        {{-- <th class="text-center text-nowrap">Tình Trạng</th> --}}
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list">
                                        <tr>
                                            <th class="text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap">@{{ value.ho + ' ' + value.dem }}</td>
                                            <td class="text-nowrap">@{{ value.ten }}</td>
                                            <td class="text-nowrap">@{{ value.so_dien_thoai }}</td>
                                            <td class="text-nowrap">@{{ value.dia_chi }}</td>
                                            <td class="text-nowrap">@{{ value.email }}</td>
                                            {{-- <td class="text-nowrap text-center">
                                                <template v-if="value.status == 0">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-warning"
                                                        style="width: 160px">Tạm tắt</button>
                                                </template>
                                                <template v-else-if="value.status == 1">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-success"
                                                        style="width: 160px">Hoạt động</button>
                                                </template>
                                                <template v-else>
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-danger"
                                                        style="width: 160px">Bị khóa</button>
                                                </template>
                                            </td> --}}
                                            <td class="text-center text-nowrap">
                                                {{-- <i v-on:click="edit = Object.assign({}, value)"
                                                    class="fa-solid fa-pen-to-square fa-2x text-info"
                                                    data-bs-toggle="modal" data-bs-target="#updateModal"
                                                    style="margin-right: 10px"></i> --}}
                                                <i v-on:click="del = value" class="fa-solid fa-trash fa-2x text-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có muốn xóa Customer <b>@{{ del.ho_lot }} @{{ del.ten }}</b>
                                            này không?</p>
                                        <p><b>Lưu ý:</b> Thao tác này không thể hoàn tác!!!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button v-on:click="destroy()" data-bs-dismiss="modal" type="button"
                                            class="btn btn-danger">Xác nhận xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Họ</label>
                                                    <input v-model="edit.ho" type="text" class="form-control"
                                                        placeholder="Nhập họ đệm">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Đệm</label>
                                                    <input v-model="edit.dem" type="text" class="form-control"
                                                        placeholder="Nhập họ đệm">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Tên</label>
                                                    <input v-model="edit.ten" type="text" class="form-control" placeholder="Nhập tên">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Rule</label>
                                                    <input v-model="edit.id_rule" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Số Điện Thoại</label>
                                                    <input v-model="edit.so_dien_thoai" type="tel" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Email</label>
                                                    <input v-on:blur="checkEmailUpdate()" v-model="edit.email" type="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-1">
                                                    <label class="form-label">Tình Trạng</label>
                                                    <select v-model="edit.status" class="form-control">
                                                        <option value="1">Hoạt động</option>
                                                        <option value="0">Tạm tắt</option>
                                                        <option value="2">Bị khóa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-1">
                                                    <label class="form-label">Địa Chỉ</label>
                                                    <input v-model="edit.dia_chi" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button id="capNhat" v-on:click="update()" type="button"
                                            class="btn btn-primary" data-bs-dismiss="modal">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
                    list: [],
                    key_search: '',
                    add: {
                        'ho_lot'        : '',
                        'ten'           : '',
                        'so_dien_thoai' : '',
                        'dia_chi'       : '',
                        'ma_so_thue'    : '',
                        'ten_cong_ty'   : '',
                        'email'         : '',
                        'status'        : 1,
                    },
                    del: {},
                    edit: {},
                },
                created() {
                    this.getData();
                },
                methods: {
                    getData() {
                        axios
                            .get('{{ Route('dataCustomer') }}')
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    timKiem() {
                        var payload = {
                            'gia_tri': this.key_search
                        };
                        axios
                            .post('{{ Route('searchCustomer') }}', payload)
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    doiTrangThai(payload) {
                        axios
                            .post('{{ Route('statusCustomer') }}', payload)
                            .then((res) => {
                                if(res.data.status) {
                                    this.getData();
                                    toastr.success(res.data.message);
                                } else {
                                    toastr.error(res.data.message);
                                }
                            });
                    },
                    // themMoi() {
                    //     axios
                    //         .post('{{ Route('createCustomer') }}', this.add)
                    //         .then((res) => {
                    //             if (res.data.status) {
                    //                 toastr.success("Đã thêm mới Customer", "Thành công!");
                    //                 // this.list.push(this.add);
                    //                 // this.getData();
                    //                 this.getDta();
                    //                 this.add = {};
                    //             }
                    //         })
                    //         .catch((res) => {
                    //             var errrors = res.response.data.errors;
                    //             $.each(errrors, function(k, v) {
                    //                 toastr.error(v[0], "Có lỗi!");
                    //             })
                    //         });
                    // },
                    destroy() {
                        axios
                            .post('{{ Route('deleteCustomer') }}', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã xóa Customer", "Thành công!");
                                    // this.list.push(this.add);
                                    this.getData();
                                }
                            })
                            .catch((res) => {
                                var errrors = res.response.data.errors;
                                $.each(errrors, function(k, v) {
                                    toastr.error(v[0], "Có lỗi!");
                                })
                            });
                    },
                    update() {
                        axios
                            .post('{{ Route('updateCustomer') }}', this.edit)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã cập nhật Customer", "Thành công!");
                                    // this.list.push(this.add);
                                    this.getData();
                                }
                            })
                            .catch((res) => {
                                var errrors = res.response.data.errors;
                                $.each(errrors, function(k, v) {
                                    toastr.error(v[0], "Có lỗi!");
                                })
                            });
                    },
                    themMoi() {
                        axios
                            .post('{{ Route('createCustomer') }}', this.add)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã thêm mới người dùng", "Thành công!");
                                    // this.list.push(this.add);
                                    // this.getData();
                                    this.timKiem();
                                    this.add = {};
                                }
                            })
                            .catch((res) => {
                                var errrors = res.response.data.errors;
                                $.each(errrors, function(k, v) {
                                    toastr.error(v[0], "Có lỗi!");
                                })
                            });
                    },
                    checkEmail() {
                        axios
                            .post('{{ Route('checkMailCustomer') }}', this.add)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Thành công!");
                                    this.mau_xanh();
                                } else {
                                    toastr.error(res.data.message, "Có lỗi!");
                                    this.mau_do();
                                }
                            });

                    },
                    mau_xanh() {
                        $("#themMoi").removeClass("btn-danger");
                        $("#themMoi").addClass("btn-primary");
                        $("#themMoi").removeAttr("disabled");
                        $("#themMoi").text("Thêm Mới Customer")
                    },

                    mau_do() {
                        $("#themMoi").removeClass("btn-primary");
                        $("#themMoi").addClass("btn-danger");
                        $("#themMoi").attr("disabled", true);
                        $("#themMoi").text("Thêm Mới Customer")
                    },

                    mau_xanh_update() {
                        $("#capNhat").removeClass("btn-danger");
                        $("#capNhat").addClass("btn-primary");
                        $("#capNhat").removeAttr("disabled");
                        $("#capNhat").text("Cập nhật")
                    },

                    mau_do_update() {
                        $("#capNhat").removeClass("btn-primary");
                        $("#capNhat").addClass("btn-danger");
                        $("#capNhat").attr("disabled", true);
                        $("#capNhat").text("Cập nhật")
                    },
                    checkEmailUpdate() {
                        axios
                            .post('{{ Route('checkMailUpdateCustomer') }}', this.edit)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Thành công!");
                                    this.mau_xanh_update();
                                } else {
                                    toastr.error(res.data.message, "Có lỗi!");
                                    this.mau_do_update();
                                }
                            });

                    },

                },
            });
        })
    </script>
@endsection
