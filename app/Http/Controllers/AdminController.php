<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdatePasswordAdminRequest;
use App\Http\Requests\UpdateProfileAdminRequest;
use App\Models\Admin;
use App\Models\ChiTietDonHang;
use App\Models\ChuyenMuc;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function logOut()
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }

    public function index_profile()
    {
        return view('admin.profile_admin');
    }

    public function getProfile()
    {
        $admin = Auth::guard('admin')->user();

        return response()->json([
            'status'    => 1,
            'data'      => $admin,    //res.data.data
        ]);
    }

    public function updateProfile(UpdateProfileAdminRequest $request)
    {
        // Với tài khoản thì phải dùng Auth để xác minh thông tin
        $admin_login = Auth::guard('admin')->user();

        Admin::where('id', $admin_login->id)
               ->update([
                    'ho_lot'        =>  $request->ho_lot,
                    'ten'           =>  $request->ten,
                    'so_dien_thoai' =>  $request->so_dien_thoai,
                    'dia_chi'       =>  $request->dia_chi,
               ]);

        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật thông tin thành công',
        ]);
    }

    public function updatePassword(UpdatePasswordAdminRequest $request)
    {
        $admin_login = Auth::guard('admin')->user();

        Admin::where('id', $admin_login->id)
               ->update([
                    'password'        =>  bcrypt($request->new_password),
               ]);

        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật thông tin thành công',
        ]);

    }
    public function viewLogin()
    {
        return view('master_blank.page_admin.login');
    }
    public function actionLogin(Request $request)
    {
        $data  = $request->all();
        $check = Auth::guard('admin')->attempt($data);    // true và false
        if($check ) {
            $admin = Admin::where('email', $request->email)
                           ->first();
            if($admin->is_active == 1) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã đăng nhập thành công!',
                ]);
            } else if($admin->is_active == 2) {
                Auth::guard('admin')->logout();
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Tài khoản đã bị khóa!',
                ]);
            } else {
                Auth::guard('admin')->logout();
                return response()->json([
                    'status'    => 3,
                    'message'   => 'Tài khoản chưa kích hoạt!',
                ]);
            }
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Tài khoản hoặc mật khẩu không đúng!',
            ]);
        }
    }
    public function index()
    {
            return view('admin.index_admin');
    }
    public function data()
    {
        $data   = Admin::get();

        return response()->json([
            'data'     => $data,
        ]);
    }

    public function status(Request $request)
    {
        // Nếu như tình trạng = 1 (Hoạt động) thì ta đổi về 2 (Bị khóa)
        // Nếu như tình trạng = 2 (Bị khóa) thì ta đổi về 0 (Chưa kích hoạt)
        // Nếu như tình trạng = 0 (Chưa kích hoạt) thì ta đổi về 1 (Hoạt động)
        $admin  = Admin::where('id', $request->id)->first();
        if($admin) {
            if($admin->is_active == 1) {
                $admin->is_active = 2;
            } else if($admin->is_active == 2){
                $admin->is_active = 0;
            } else {
                $admin->is_active = 1;
            }
            $admin->save();
        }
    }
    public function store(CreateAdminRequest $request)
    {
        $data               = $request->all();
        $data['password']   = bcrypt($request->password);

        Admin::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function destroy(Request $request)
    {
        $admin = Admin::where('id', $request->id)
                              ->first();

        if($admin) {
            $admin->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa admin thành công',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Admin không tồn tại',
            ]);
        }
    }
    public function edit(Request $request)
    {
        $admin = Admin::where('id', $request->id)
                              ->first();

        if($admin) {
            return response()->json([
                'status'    => true,
                'data'      => $admin,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Dữ liệu không chính xác!',
            ]);
        }
    }
    public function update(UpdateAdminRequest $request)
    {
        $admin  = Admin::where('id', $request->id)->first();
        if($admin) {
            $admin->update([
                'ho_lot'            =>  $request->ho_lot,
                'ten'               =>  $request->ten,
                'id_rule'           =>  $request->id_rule,
                'so_dien_thoai'     =>  $request->so_dien_thoai,
                'dia_chi'           =>  $request->dia_chi,
                'email'             =>  $request->email,
                'password'          =>  $request->password,
                'is_active'         =>  $request->is_active,
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'Đã cập nhật admin',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Admin không tồn tại',
            ]);
        }
    }
    public function checkMail(Request $request)
    {
        $admin = Admin::where('email', $request->email)
                              ->get();
        if(count($admin) > 0) {
            return response()->json([
                'status'    => false,
                'message'   => 'Email đã tồn tại',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Có thể sử dụng email này',
            ]);
        }
    }
    public function checkMailUpdate(Request $request)
    {
        $admin = Admin::where('email', $request->email)
                            ->where('id', '<>', $request->id)
                            ->get();
        if(count($admin) > 0) {
            return response()->json([
                'status'    => false,
                'message'   => 'Email đã tồn tại',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Có thể sử dụng email này',
            ]);
        }
    }
    public function search(Request $request)
    {
        $gia_tri    = '%' . $request->gia_tri . '%';

        $data       = Admin::where('ho_lot', 'like', $gia_tri)
                               ->orWhere('ten', 'like', $gia_tri)
                               ->orWhere('so_dien_thoai', 'like', $gia_tri)
                               ->orWhere('dia_chi', 'like', $gia_tri)
                               ->orWhere('email', 'like', $gia_tri)
                               ->get();
        return response()->json([
            'data'     => $data,
        ]);
    }

    public function dataAdmin()
    {
        $data   = ChuyenMuc::get();

        return response()->json([
            'data'     => $data,
        ]);
    }











        public function viewDonHangAdmin()
        {
            return view('partner.don_hang.index');
        }

        public function index_dashboards()
        {
            return view('admin.admin.dashboards');
        }
        public function dataDonHangAdmin()
        {
            $partner    = Auth::guard('partner')->user();

            $data       = DonHang::where('id_partner', $partner->id)
                                 ->orderByDESC('id')
                                 ->get();

            return response()->json([
                'status'    => 1,
                'data'      => $data,
            ]);
        }

        public function tinhTongSoLuongXuat($id_san_pham, $id_partner)
        {
            $tong   =   ChiTietDonHang::where('id_san_pham', $id_san_pham)
                                      ->where('id_partner', $id_partner)
                                      ->join('don_hangs', 'chi_tiet_don_hangs.id_don_hang', 'don_hangs.id')
                                      ->where('don_hangs.tinh_trang', '>=', 1)
                                      ->sum('so_luong_mua');
            return $tong;
        }

        public function doiTrangThaiDonHangAdmin(Request $request)
        {
            $partner    = Auth::guard('partner')->user();

            $donHang    = DonHang::where('id', $request->id)
                                 ->where('id_partner', $partner->id)
                                 ->first();

            if(!$donHang) {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đơn hàng không tồn tại!',
                ]);
            }

            // dd($donHang->tinh_trang);
            // Nghiệp vụ
            if($donHang->tinh_trang == \App\Models\DonHang::DA_NHAN_HANG) {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đơn hàng đã giao không thể đổi trạng thái',
                ]);
            }

            if($donHang->tinh_trang == \App\Models\DonHang::DON_HANG_HUY_DO_KHACH || $donHang->tinh_trang == \App\Models\DonHang::DON_HANG_HUY_DO_PARTNER) {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đơn hàng đã hủy không thể đổi trạng thái',
                ]);
            }

            if($donHang->tinh_trang == \App\Models\DonHang::DANG_GIAO_HANG) {
                if($request->tinh_trang != \App\Models\DonHang::DA_NHAN_HANG && $request->tinh_trang != \App\Models\DonHang::DON_HANG_HUY_DO_KHACH) {
                    return response()->json([
                        'status'    => 0,
                        'message'   => 'Đơn hàng đang giao thi chỉ đổi được sang nhận hoặc hoặc hủy do khách',
                    ]);
                }
            }

            // còn gì tưởng tượng được thì viết tiếp ở trên
            $donHang->tinh_trang    = $request->tinh_trang;
            $donHang->save();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật đơn hàng!',
            ]);

            if($request->tinh_trang >= 1) {
                // 1. Lấy toàn bộ chi tiết đơn hàng
                $danh_sach      = ChiTietDonHang::where('id_don_hang', $donHang->id)->get();
                foreach($danh_sach as $k => $v) {
                    // a. Ta sẽ tìm sản phẩm
                    $san_pham                   = SanPham::find($v->id_san_pham);
                    $san_pham->so_luong_ban     = $this->tinhTongSoLuongXuat($v->id_san_pham, $v->id_partner);
                    $san_pham->save();
                }
            }
        }

        public function chiTietDonHangAdmin(Request $request)
        {
            $partner    = Auth::guard('partner')->user();

            $data   = ChiTietDonHang::where('id_don_hang', $request->id)
                                    ->where('id_partner', $partner->id)
                                    ->get();

            return response()->json([
                'status'    => 1,
                'data'      => $data,
                'tong_tien' => $data->sum('thanh_tien_mua'),
            ]);
        }

        public function searchDonHang(Request $request)
        {
            $gia_tri    = '%' . $request->gia_tri . '%';

            $data       = DonHang::where('ten_nguoi_nhan', 'like', $gia_tri)
                                   ->orWhere('so_dien_thoai', 'like', $gia_tri)
                                   ->get();
            return response()->json([
                'data'     => $data,
            ]);
        }

}
