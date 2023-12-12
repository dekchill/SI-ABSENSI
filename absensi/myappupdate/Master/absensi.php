<?php

namespace Master;

use Config\Query_builder;

class absensi
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('absensi')->get()->resultArray();
        $res = ' <a href="?target=absensi&act=tambah_absensi" class="btn btn-info btn-sm">Tambah absensi</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>id_karyawan</th>
                    <th>Nama</th>
                    <th>jabatan</th>
                    <th>alamat</th>
                    <th>tujuan</th>
                    <th>waktukehadiran</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                    <td width="100">' . $r['id_karyawan'] . '</td>
                    <td>' . $r['Nama'] . '</td>
                    <td width="10">' . $r['jabatan'] . '</td>
                    <td>' . $r['alamat'] . '</td>
                    <td>' . $r['tujuan'] . '</td>
                    <td>' . $r['waktukehadiran'] . '</td>
                    <td width="150">
                        <a href="?target=absensi&act=edit_absensi&id=' . $r['id_karyawan'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=absensi&act=delete_absensi&id=' . $r['id_karyawan'] . '" class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=absensi" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=absensi&act=simpan_absensi" method="post">
                    <div class="mb-3">
                        <label for="id_karyawan" class="form-label">id_karyawan</label>
                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="Nama" name="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">tujuan</label>
                        <input type="text" class="form-control" id="tujuan" name="tujuan">
                    </div>
                    <div class="mb-3">
                        <label for="waktukehadiran" class="form-label">waktukehadiran</label>
                        <input type="text" class="form-control" id="waktukehadiran" name="waktukehadiran">
                    </div>
                  
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }

    public function simpan()
    {
        $id_karyawan = $_POST['id_karyawan'];
        $Nama = $_POST['Nama'];
        $jabatan = $_POST['jabatan'];
        $alamat = $_POST['alamat'];
        $tujuan = $_POST['tujuan'];
        $waktukehadiran = $_POST['waktukehadiran'];

        $data = array(
            'id_karyawan' => $id_karyawan,
            'Nama' => $Nama,
            'jabatan' => $jabatan,
            'alamat' => $alamat,
            'tujuan' => $tujuan,
            'waktukehadiran' => $waktukehadiran
        );
        return $this->db->table('absensi')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('absensi')->where("id_karyawan='$id'")->get()->rowArray();

        $res = '<a href="?target=absensi" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=absensi&act=update_absensi" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_karyawan'] . '">
                    <div class="mb-3">
                        <label for="id_karyawan" class="form-label">id_karyawan</label>
                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" value="' . $r['id_karyawan'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="Nama" name="Nama" value="' . $r['Nama'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="' . $r['jabatan'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="' . $r['alamat'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">tujuan</label>
                        <input type="text" class="form-control" id="tujuan" name="tujuan" value="' . $r['tujuan'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="waktukehadiran" class="form-label">waktukehadiran</label>
                        <input type="text" class="form-control" id="waktukehadiran" name="waktukehadiran" value="' . $r['waktukehadiran'] . '">
                    </div>

                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>';
        return $res;
    }

    public function cekRadio($val1, $val2)
    {
        if ($val1 == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $id_pegawai = $_POST['id_karyawan'];
        $Nama = $_POST['Nama'];
        $jabatan = $_POST['jabatan'];
        $alamat = $_POST['alamat'];
        $tujuan = $_POST['tujuan'];
        $waktukehadiran = $_POST['waktukehadiran'];

        $data = array(
            'id_karyawan' => $id_karyawan,
            'Nama' => $Nama,
            'jabatan' => $jabatan,
            'alamat' => $alamat,
            'tujuan' => $tujuan,
            'waktukehadiran' => $waktukehadiran
        );

        return $this->db->table('absensi')->where("id_karyawan='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('absensi')->where("id_karyawan='$id'")->delete();
    }
}
