<?php
/* ===========================================================
   Mailer‑segéd –  lábléc Ajánlatkérés + Leiratkozás
=========================================================== */

/**
 * Szép HTML‑lábléc CTA‑val és leiratkozó linkkel.
 *
 * @param string $email      Címzett e-mail címe (trackinghez)
 * @param int    $kuldes_id  Kampány ID (trackinghez)
 * @return string            Táblás, inlinesített HTML
 */
 /* ===========================================================
    Mailer‑lábléc  –  széltől szélig háttér
 =========================================================== */
 require_once __DIR__.'/../config.php';

 function email_footer(string $email, int $kuldes_id): string
 {
     /* ===== Linkek összeállítása ================================= */
     $cta_link  = 'https://bnbk.hu/aloldalak/ajanlatkeres.php';
     $cta_url   = 'https://bnbk.hu/admin/click.php'
                . '?email='     . urlencode($email)
                . '&kuldes_id=' . $kuldes_id
                . '&link='      . urlencode($cta_link);

     $uns_url   = 'https://bnbk.hu/admin/unsubscribe.php'
                . '?email='     . urlencode($email)
                . '&kuldes_id=' . $kuldes_id;

     /* ===== Teljes szélességű táblás HTML ======================= */
     return '
 <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
        style="font-family:Arial,Helvetica,sans-serif;background:#1f1f1f;">
   <!-- CTA sáv -->
   <tr>
     <td align="center" style="padding:32px 0;">
       <a href="'.$cta_url.'"
          style="background:#198754;color:#ffffff;
                 padding:14px 28px;font-size:16px;line-height:22px;
                 font-weight:bold;text-decoration:none;border-radius:4px;">
         Kérj ajánlatot most
       </a>
     </td>
   </tr>

   <!-- Leiratkozás + copyright -->
   <tr>
     <td align="center"
         style="padding:18px 12px;background:#141414;
                font-size:12px;line-height:18px;color:#cccccc;">
       Ha nem szeretnél több e‑mailt kapni,
       <a href="'.$uns_url.'" style="color:#9ad4b0;text-decoration:none;">iratkozz le itt</a>.<br>
       © '.date('Y').' BNBK Agro Kft.
     </td>
   </tr>
 </table>';
 }

 ?>
