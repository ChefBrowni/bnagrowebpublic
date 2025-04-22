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
function email_footer(string $email, int $kuldes_id): string
{
    /* ---- URL-ek -------------------------------------------------- */
    $cta_orig = 'https://bnbk.hu/aloldalak/ajanlatkeres.php';
    $cta_url  = 'https://bnbk.hu/admin/click.php'
              . '?email='     . urlencode($email)
              . '&kuldes_id=' . $kuldes_id
              . '&link='      . urlencode($cta_orig);

    $uns_url  = 'https://bnbk.hu/admin/unsubscribe.php'
              . '?email='     . urlencode($email)
              . '&kuldes_id=' . $kuldes_id;

    /* ---- HTML (600 px széles kártya) ----------------------------- */
    return '
    <table role="presentation" cellpadding="0" cellspacing="0"
           style="width:100%;max-width:600px;margin:40px auto 0;
                  font-family:Arial,Helvetica,sans-serif;">
      <tr>
        <td style="background:#2b2b2b;
                   padding:24px 24px 20px;
                   text-align:center;
                   color:#f8f9fa;
                   border-radius:8px 8px 0 0;">

          <!-- CTA gomb -->
          <a href="'.$cta_url.'"
             style="background:#198754;
                    color:#ffffff;
                    padding:14px 28px;
                    font-size:16px;
                    line-height:22px;
                    text-decoration:none;
                    font-weight:bold;
                    border-radius:4px;
                    display:inline-block;">
            Kérj ajánlatot most
          </a>

        </td>
      </tr>

      <tr>
        <td style="background:#1f1f1f;
                   padding:16px 24px;
                   text-align:center;
                   font-size:12px;
                   line-height:18px;
                   color:#cccccc;
                   border-radius:0 0 8px 8px;">

          Ha nem szeretnél több e‑mailt kapni,
          <a href="'.$uns_url.'" style="color:#9ad4b0;text-decoration:none;">iratkozz le itt</a>.<br>
          © '.date('Y').' BNBK Agro Kft.
        </td>
      </tr>
    </table>';
}
