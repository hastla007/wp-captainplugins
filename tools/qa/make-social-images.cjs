#!/usr/bin/env node
/**
 * Render the 1200×630 social preview images into theme/captain-plugins/assets/social/.
 * Usage: cd tools/qa && node make-social-images.cjs   (taglines and poses are listed in `items`)
 */
const { chromium } = require('playwright'); const fs = require('fs'); const path = require('path');
const theme = path.resolve(__dirname, '../../theme/captain-plugins');
const css = fs.readFileSync(theme + '/assets/css/theme.css', 'utf8');
const icon = (k) => (css.match(new RegExp('--cp-icon-' + k + ': (url\\("data:image/svg\\+xml,[^"]+"\\))')) || [])[1];
const img = (n) => 'data:image/webp;base64,' + fs.readFileSync(`${theme}/assets/images/captain-${n}.webp`).toString('base64');
const items = [
 ['startseite','anchor','Captain Plugins','Geschäftsprozesse in WordPress. Klar organisiert.','pointing'],
 ['voucher-captain','voucher','Voucher Captain','Gutscheine und Geschenkkarten in WooCommerce verkaufen','thumbs'],
 ['pass-captain','pass','Pass Captain','Events, Tickets und Buchungen in WordPress','thumbs'],
 ['affiliate-captain','affiliate','Affiliate Captain','Partnerprogramme und Provisionen nachvollziehbar steuern','thumbs'],
 ['form-captain','form','Form Captain','Formulare erstellen und Einsendungen verwalten','thumbs'],
 ['review-captain','review','Review Captain','Kundenbewertungen sammeln und zeigen','thumbs'],
 ['workflow-captain','workflow','Workflow Captain','WordPress- und WooCommerce-Abläufe automatisieren','thumbs'],
 ['license-captain','license','License Captain','Lizenzen und Updates für Ihre WordPress-Plugins','arms'],
 ['captain-pro','anchor','Captain Pro','Mehr Funktionen für Ihre Captain-Plugins','pointing'],
];
(async () => {
  const b = await chromium.launch(process.env.CHROMIUM_PATH ? { executablePath: process.env.CHROMIUM_PATH } : {}); const p = await b.newPage({ viewport: { width: 1200, height: 630 } });
  for (const [slug, ic, name, claim, pose] of items) {
    const html = `<!doctype html><meta charset="utf-8"><style>
      body{margin:0;width:1200px;height:630px;overflow:hidden;font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;background:#143B53;color:#fff;position:relative}
      .wave{position:absolute;inset:auto 0 0 0;height:170px;background:#0f3044;clip-path:ellipse(75% 100% at 40% 100%)}
      .brand{position:absolute;left:80px;top:64px;display:flex;align-items:center;gap:14px;font-weight:800;letter-spacing:.06em;font-size:26px}
      .brand i{width:40px;height:40px;background:#D5A64A;-webkit-mask:${icon('anchor')} center/contain no-repeat}
      .tile{position:absolute;left:80px;top:178px;width:104px;height:104px;border-radius:22px;background:#EAF2F6}
      .tile i{position:absolute;inset:20px;background:#143B53;-webkit-mask:${icon(ic)} center/contain no-repeat}
      h1{position:absolute;left:80px;top:300px;margin:0;font-size:${name.length>14?60:72}px;line-height:1.05;letter-spacing:-.03em;max-width:600px}
      p{position:absolute;left:80px;top:${name.length>14?386:398}px;margin:0;font-size:29px;line-height:1.3;color:#c4d4de;max-width:580px}
      .bar{position:absolute;left:80px;top:${name.length>15?378:392}px;width:72px;height:6px;border-radius:3px;background:#D5A64A;display:none}
      .disc{position:absolute;right:40px;top:95px;width:440px;height:440px;border-radius:50%;background:#EAF2F6;box-shadow:0 0 0 14px rgba(213,166,74,.9)}
      .captain{position:absolute;right:110px;bottom:-20px;height:580px}
    </style><div class="wave"></div><div class="brand"><i></i>CAPTAIN PLUGINS</div><div class="tile"><i></i></div><h1>${name}</h1><p>${claim}</p><div class="disc"></div><img class="captain" src="${img(pose)}" alt="">`;
    await p.setContent(html); await p.waitForTimeout(100);
    await p.screenshot({ path: `${theme}/assets/social/${slug}.jpg`, type: 'jpeg', quality: 86 });
  }
  await b.close();
})();
