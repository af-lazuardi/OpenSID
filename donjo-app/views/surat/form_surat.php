<!--
*
* Kalau ada file form surat di folder desa, pakai file itu.
* Urutan: (1) LOKASI_SURAT_DESA/<folder_surat_ini>
*         (2) LOKASI_SURAT_FORM_DESA
* Kalau tidak ada, pakai file form surat yang disediakan di release SID
* di donjo-app/surat/<folder_surat_ini>
*
 -->
<?php
  $nama_surat = $url;
  $form_surat = LOKASI_SURAT_DESA . $nama_surat . "/" . $nama_surat . ".php";

  if (is_file($form_surat)) {
    $includee = $form_surat;
  } else if (is_file(LOKASI_SURAT_FORM_DESA . $nama_surat . ".php")) {
    $includee = LOKASI_SURAT_FORM_DESA . $nama_surat . ".php";
  } else {
    $includee = "./template-surat/$nama_surat/$nama_surat.php";
  }

  include($includee);
?>
<textarea id="isian_form" hidden="hidden"><?= $isian_form?></textarea>

<script type="text/javascript">
  $(document).ready(function() {
    // Di form surat ubah isian admin menjadi disabled
    $("#periksa-permohonan .readonly-periksa").attr('disabled', true);
    if ($('#isian_form').val())
    {
      setTimeout(function() {isi_form();}, 100);
    }
  });

  function isi_form()
  {
    var isian_form = JSON.parse($('#isian_form').val(), function(key, value)
    {
      if (key)
      {
        var elem = $('*[name=' + key + ']');
        elem.val(value);
        elem.change();
        // Kalau isian hidden, akan ada isian lain untuk menampilkan datanya
        if (elem.is(":hidden"))
        {
          var show = $('#' + key + '_show');
          show.val(value);
          show.change();
        }
      }
    });
  }
</script>
