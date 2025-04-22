<?php
/* ------------------------------------------------------------------
 |  Mailer‑segédfüggvények (újrafelhasználható header / footer)
 * -----------------------------------------------------------------*/

/**
 * E‑mail‑lábléc létrehozása (jelenleg csak cégnév + évszám).
 * A leiratkozó linket később ide illesztjük.
 *
 * @param string $ev   – aktuális év (pl. date('Y'))
 * @return string      – HTML‑lábléc (táblás, 100 % kompatibilis)
 */
function email_footer(string $ev): string
{
    return '
    <table role="presentation" cellpadding="0" cellspacing="0"
           style="width:100%;max-width:600px;margin:32px auto 0;
                  font-family:Arial,Helvetica,sans-serif;font-size:12px;
                  line-height:18px;color:#666;text-align:center;">
      <tr>
        <td style="padding:16px;border-top:1px solid #ddd;">
          © '.$ev.' BNBK Agro Kft. – Minden jog fenntartva
        </td>
      </tr>
    </table>';
}
