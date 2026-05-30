<?php
declare(strict_types=1);

$wpLoad = '/Users/manyabisht/Local Sites/maisonvellum/app/public/wp-load.php';

if (! file_exists($wpLoad)) {
    fwrite(STDERR, "WordPress bootstrap not found at {$wpLoad}\n");
    exit(1);
}

require $wpLoad;

$author = get_user_by('login', 'Maison');
if (! $author) {
    $author = get_users(['role__in' => ['administrator'], 'number' => 1])[0] ?? null;
}

if (! $author) {
    fwrite(STDERR, "No administrator user was found.\n");
    exit(1);
}

wp_set_current_user((int) $author->ID);

update_option('blogname', 'Maison Vellum');
update_option('blogdescription', 'Spatial curation for tactile, quietly expressive interiors.');

function mv_page_html(string $key): string
{
    $pages = [
        'home' => <<<'HTML'
<!-- wp:html -->
<main class="mv-page mv-home">
  <section class="mv-hero" aria-labelledby="mv-home-title">
    <header class="mv-nav" aria-label="Maison Vellum primary navigation">
      <a class="mv-wordmark" href="/">Maison Vellum</a>
      <nav class="mv-menu" aria-label="Primary">
        <a href="#philosophy">Philosophy</a>
        <a href="/projects/">Projects</a>
        <a href="/services/">Services</a>
        <a href="/inquiry/">Inquiry</a>
      </nav>
    </header>
    <div class="mv-hero-grid">
      <div class="mv-kicker">Private residential interiors</div>
      <h1 id="mv-home-title">Rooms composed with restraint, ritual, and a precise sense of touch.</h1>
      <p class="mv-hero-copy">Maison Vellum shapes homes as living manuscripts - layered with material intelligence, calm proportion, and the intimate habits of the people within them.</p>
    </div>
    <div class="mv-hero-plate" role="img" aria-label="Warm plaster, walnut, and linen interior study">
      <span>atelier study</span>
    </div>
  </section>

  <section id="philosophy" class="mv-section mv-philosophy" aria-labelledby="mv-philosophy-title">
    <div class="mv-container mv-split">
      <div>
        <p class="mv-kicker">Design philosophy</p>
        <h2 id="mv-philosophy-title">Spatial curation before decoration.</h2>
      </div>
      <div class="mv-narrative">
        <p>We begin with the architecture of a life: the morning light, the threshold between public and private, the hand-feel of stone, timber, wool, and silence.</p>
        <p>Every commission is developed as an architectural narrative, where proportion leads, materials speak softly, and each room earns its quiet.</p>
      </div>
    </div>
  </section>

  <section class="mv-section mv-featured" aria-labelledby="mv-featured-title">
    <div class="mv-container">
      <div class="mv-section-head">
        <p class="mv-kicker">Selected atmospheres</p>
        <h2 id="mv-featured-title">Featured project studies</h2>
      </div>
      <div class="mv-gallery-preview">
        <figure class="mv-project-card mv-offset-low">
          <div class="mv-image-plate mv-plate-stone" role="img" aria-label="Soft stone living room material placeholder"></div>
          <figcaption>
            <span>Stone House</span>
            <em>limestone, shearling, shadow</em>
          </figcaption>
        </figure>
        <figure class="mv-project-card mv-offset-high">
          <div class="mv-image-plate mv-plate-walnut" role="img" aria-label="Walnut library material placeholder"></div>
          <figcaption>
            <span>Rue Library</span>
            <em>walnut, vellum, low brass</em>
          </figcaption>
        </figure>
        <figure class="mv-project-card mv-wide">
          <div class="mv-image-plate mv-plate-linen" role="img" aria-label="Linen bedroom material placeholder"></div>
          <figcaption>
            <span>North Suite</span>
            <em>linen, plaster, quiet daylight</em>
          </figcaption>
        </figure>
      </div>
    </div>
  </section>
</main>
<!-- /wp:html -->
HTML,
        'projects' => <<<'HTML'
<!-- wp:html -->
<main class="mv-page mv-projects">
  <header class="mv-subhero" aria-labelledby="mv-projects-title">
    <div class="mv-container">
      <div class="mv-subnav" aria-label="Maison Vellum primary navigation">
        <a class="mv-wordmark" href="/">Maison Vellum</a>
        <nav class="mv-menu" aria-label="Primary">
          <a href="/">Home</a>
          <a href="/projects/">Projects</a>
          <a href="/services/">Services</a>
          <a href="/inquiry/">Inquiry</a>
        </nav>
      </div>
      <p class="mv-kicker">Portfolio</p>
      <h1 id="mv-projects-title">Interior studies in material restraint.</h1>
      <p>Each project is held as a distinct atmosphere, shaped through architectural narratives, commissioned pieces, and a closely edited material language.</p>
    </div>
  </header>

  <section class="mv-section" aria-label="Project gallery">
    <div class="mv-container mv-masonry">
      <figure class="mv-project-card mv-tall">
        <div class="mv-image-plate mv-plate-plaster" role="img" aria-label="Plaster salon project placeholder"></div>
        <figcaption><span>Belgrave Salon</span><em>hand-troweled plaster and aged oak</em></figcaption>
      </figure>
      <figure class="mv-project-card">
        <div class="mv-image-plate mv-plate-charcoal" role="img" aria-label="Charcoal dining room project placeholder"></div>
        <figcaption><span>Charcoal Dining</span><em>matte mineral paint and monolithic stone</em></figcaption>
      </figure>
      <figure class="mv-project-card mv-tall">
        <div class="mv-image-plate mv-plate-walnut" role="img" aria-label="Walnut library project placeholder"></div>
        <figcaption><span>Rue Library</span><em>wall-to-wall walnut, parchment lamps</em></figcaption>
      </figure>
      <figure class="mv-project-card">
        <div class="mv-image-plate mv-plate-linen" role="img" aria-label="Linen bedroom project placeholder"></div>
        <figcaption><span>North Suite</span><em>washed linen and soft architectural light</em></figcaption>
      </figure>
      <figure class="mv-project-card mv-wide-card">
        <div class="mv-image-plate mv-plate-stone" role="img" aria-label="Stone residence project placeholder"></div>
        <figcaption><span>Stone House</span><em>limestone, curved thresholds, wool boucle</em></figcaption>
      </figure>
      <figure class="mv-project-card">
        <div class="mv-image-plate mv-plate-brass" role="img" aria-label="Brass powder room project placeholder"></div>
        <figcaption><span>Gilded Powder</span><em>smoked mirror and unlacquered brass</em></figcaption>
      </figure>
    </div>
  </section>
</main>
<!-- /wp:html -->
HTML,
        'services' => <<<'HTML'
<!-- wp:html -->
<main class="mv-page mv-services">
  <header class="mv-subhero" aria-labelledby="mv-services-title">
    <div class="mv-container">
      <div class="mv-subnav" aria-label="Maison Vellum primary navigation">
        <a class="mv-wordmark" href="/">Maison Vellum</a>
        <nav class="mv-menu" aria-label="Primary">
          <a href="/">Home</a>
          <a href="/projects/">Projects</a>
          <a href="/services/">Services</a>
          <a href="/inquiry/">Inquiry</a>
        </nav>
      </div>
      <p class="mv-kicker">Services</p>
      <h1 id="mv-services-title">Boutique design for deeply considered homes.</h1>
      <p>Maison Vellum accepts a limited number of commissions, allowing each project to be studied at the level of proportion, atmosphere, and touch.</p>
    </div>
  </header>

  <section class="mv-section mv-service-section" aria-label="Boutique offerings">
    <div class="mv-container mv-service-list">
      <article class="mv-service-item">
        <span>01</span>
        <div>
          <h2>Residential Curation</h2>
          <p>Whole-home interiors composed through spatial flow, furniture silhouettes, art placement, and daily rituals. The result is personal, edited, and never over-explained.</p>
        </div>
      </article>
      <article class="mv-service-item">
        <span>02</span>
        <div>
          <h2>Spatial Architecture</h2>
          <p>Interior architecture for rooms that require more than styling: threshold studies, built-in millwork, lighting rhythm, and the measured sequence between spaces.</p>
        </div>
      </article>
      <article class="mv-service-item">
        <span>03</span>
        <div>
          <h2>Material Sourcing</h2>
          <p>A tactile library of stone, plaster, timber, metal, textile, and artisan finishes, selected for patina, restraint, and the subtle tension between rawness and refinement.</p>
        </div>
      </article>
      <article class="mv-service-item">
        <span>04</span>
        <div>
          <h2>Installation Direction</h2>
          <p>Final styling, placement, and room composition handled with quiet precision so the finished space feels inevitable rather than staged.</p>
        </div>
      </article>
    </div>
  </section>

  <section class="mv-section mv-method" aria-labelledby="mv-method-title">
    <div class="mv-container mv-split">
      <div>
        <p class="mv-kicker">Method</p>
        <h2 id="mv-method-title">Measured, private, exacting.</h2>
      </div>
      <p>From first study to final installation, the studio works through mood, proportion, procurement, and construction coordination with a deliberately calm cadence.</p>
    </div>
  </section>
</main>
<!-- /wp:html -->
HTML,
        'inquiry' => <<<'HTML'
<!-- wp:html -->
<main class="mv-page mv-inquiry">
  <header class="mv-subhero" aria-labelledby="mv-inquiry-title">
    <div class="mv-container">
      <div class="mv-subnav" aria-label="Maison Vellum primary navigation">
        <a class="mv-wordmark" href="/">Maison Vellum</a>
        <nav class="mv-menu" aria-label="Primary">
          <a href="/">Home</a>
          <a href="/projects/">Projects</a>
          <a href="/services/">Services</a>
          <a href="/inquiry/">Inquiry</a>
        </nav>
      </div>
      <p class="mv-kicker">Private inquiry</p>
      <h1 id="mv-inquiry-title">Begin with the atmosphere you want to live inside.</h1>
      <p>A short intake for homes, apartments, and private spaces seeking a highly tailored interior language.</p>
    </div>
  </header>

  <section class="mv-section mv-inquiry-section" aria-label="Client intake form">
    <div class="mv-container mv-inquiry-grid">
      <aside>
        <p class="mv-kicker">Client intake</p>
        <h2>Tell us what the room must hold.</h2>
        <p>Maison Vellum responds to inquiries with a quiet discovery conversation, followed by a tailored scope and studio availability.</p>
      </aside>

      <form class="mv-inquiry-form" action="#" method="post">
        <label>
          <span>Name</span>
          <input type="text" name="mv-name" autocomplete="name" placeholder="Your name">
        </label>
        <label>
          <span>Return email</span>
          <input type="email" name="mv-email" autocomplete="email" placeholder="name@example.com">
        </label>
        <label>
          <span>Project scope</span>
          <select name="mv-scope">
            <option>Full residence</option>
            <option>Single room composition</option>
            <option>Interior architecture and millwork</option>
            <option>Material palette consultation</option>
          </select>
        </label>
        <fieldset>
          <legend>Aesthetic preferences</legend>
          <label><input type="checkbox" name="mv-preferences[]" value="warm-minimal"> Warm minimalism</label>
          <label><input type="checkbox" name="mv-preferences[]" value="architectural"> Architectural restraint</label>
          <label><input type="checkbox" name="mv-preferences[]" value="tactile"> Tactile natural materials</label>
          <label><input type="checkbox" name="mv-preferences[]" value="heritage"> Heritage pieces, softly modernized</label>
        </fieldset>
        <label>
          <span>Atmosphere notes</span>
          <textarea name="mv-notes" rows="6" placeholder="Share the light, materials, rooms, rituals, or constraints you are considering."></textarea>
        </label>
        <button type="submit">Send inquiry</button>
      </form>
    </div>
  </section>
</main>
<!-- /wp:html -->
HTML,
    ];

    return $pages[$key] ?? '';
}

function mv_upsert_page(string $title, string $slug, string $content, int $authorId, int $order): int
{
    $existing = get_page_by_path($slug, OBJECT, 'page');

    $post = [
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_content' => $content,
        'post_author' => $authorId,
        'menu_order' => $order,
        'comment_status' => 'closed',
        'ping_status' => 'closed',
    ];

    if ($existing) {
        $post['ID'] = (int) $existing->ID;
        $id = wp_update_post($post, true);
    } else {
        $id = wp_insert_post($post, true);
    }

    if (is_wp_error($id)) {
        fwrite(STDERR, $id->get_error_message() . "\n");
        exit(1);
    }

    update_post_meta((int) $id, '_mv_layout_version', '2026-05-29-editorial-v1');
    update_post_meta((int) $id, '_wp_page_template', 'default');

    return (int) $id;
}

$pageIds = [
    'home' => mv_upsert_page('Home', 'home', mv_page_html('home'), (int) $author->ID, 1),
    'projects' => mv_upsert_page('Portfolio / Projects', 'projects', mv_page_html('projects'), (int) $author->ID, 2),
    'services' => mv_upsert_page('Services', 'services', mv_page_html('services'), (int) $author->ID, 3),
    'inquiry' => mv_upsert_page('Contact / Inquiry', 'inquiry', mv_page_html('inquiry'), (int) $author->ID, 4),
];

update_option('show_on_front', 'page');
update_option('page_on_front', $pageIds['home']);

$bodySelectors = array_map(static fn (int $id): string => "body.page-id-{$id}", array_values($pageIds));
$scope = implode(', ', $bodySelectors);
$hideChrome = implode(' .site-header, ', $bodySelectors) . ' .site-header, '
    . implode(' .site-footer, ', $bodySelectors) . ' .site-footer, '
    . implode(' .page-header, ', $bodySelectors) . ' .page-header, '
    . implode(' .entry-title, ', $bodySelectors) . ' .entry-title';

$customCss = <<<CSS
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap');

:root {
  --mv-cream: #f6f1e8;
  --mv-paper: #fbf8f1;
  --mv-linen: #e6ded1;
  --mv-stone: #cfc4b4;
  --mv-taupe: #8f806d;
  --mv-clay: #a68972;
  --mv-moss: #737664;
  --mv-charcoal: #20201c;
  --mv-ink: #34312c;
  --mv-border: rgba(52, 49, 44, 0.22);
  --mv-shadow: 0 26px 70px rgba(40, 34, 28, 0.12);
  --mv-max: min(1120px, calc(100vw - 48px));
}

body {
  background: var(--mv-cream);
  color: var(--mv-ink);
  font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  font-size: 16px;
  font-weight: 300;
  line-height: 1.75;
  letter-spacing: 0;
}

h1,
h2,
h3 {
  color: var(--mv-charcoal);
  font-family: "Cormorant Garamond", Georgia, serif;
  font-weight: 500;
  letter-spacing: 0;
  line-height: 0.96;
}

{$scope} {
  background: var(--mv-cream);
}

{$scope} #content,
{$scope} .site-main,
{$scope} .page-content,
{$scope} .entry-content {
  margin: 0;
  max-width: none;
  padding: 0;
}

{$hideChrome} {
  display: none;
}

.mv-page,
.mv-page * {
  box-sizing: border-box;
}

.mv-page {
  background:
    linear-gradient(90deg, rgba(32, 32, 28, 0.035) 1px, transparent 1px) 0 0 / 96px 96px,
    var(--mv-cream);
  color: var(--mv-ink);
  margin: 0;
  overflow: hidden;
}

.mv-page a {
  color: inherit;
  text-decoration: none;
}

.mv-container {
  margin: 0 auto;
  width: var(--mv-max);
}

.mv-section {
  padding: clamp(80px, 9vw, 120px) 0;
}

.mv-nav {
  align-items: center;
  display: flex;
  justify-content: space-between;
  margin: 0 auto;
  padding: 34px 0 0;
  position: relative;
  width: var(--mv-max);
  z-index: 3;
}

.mv-wordmark {
  color: var(--mv-charcoal);
  display: inline-block;
  font-family: "Cormorant Garamond", Georgia, serif;
  font-size: clamp(28px, 3vw, 44px);
  font-weight: 500;
  line-height: 1;
}

.mv-menu {
  align-items: center;
  display: flex;
  flex-wrap: wrap;
  gap: clamp(14px, 2vw, 30px);
  justify-content: flex-end;
}

.mv-menu a,
.mv-kicker,
.mv-project-card em,
.mv-service-item > span {
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.16em;
  text-transform: uppercase;
}

.mv-menu a {
  color: rgba(32, 32, 28, 0.72);
  padding-bottom: 5px;
  position: relative;
}

.mv-menu a::after {
  background: var(--mv-charcoal);
  bottom: -42px;
  content: "";
  height: 1px;
  left: 0;
  position: absolute;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 220ms ease;
  width: 100%;
}

.mv-menu a:hover::after,
.mv-menu a:focus-visible::after {
  transform: scaleX(1);
}

.mv-hero {
  min-height: clamp(650px, 84vh, 820px);
  padding-bottom: clamp(36px, 6vw, 72px);
  position: relative;
}

.mv-hero-grid {
  display: grid;
  gap: 26px;
  grid-template-columns: minmax(0, 0.72fr) minmax(280px, 1.28fr);
  margin: clamp(54px, 7vw, 92px) auto 0;
  position: relative;
  width: var(--mv-max);
  z-index: 2;
}

.mv-kicker {
  color: var(--mv-taupe);
  margin: 0;
}

.mv-hero h1 {
  font-size: clamp(50px, 6.4vw, 100px);
  margin: 0;
  max-width: 900px;
}

.mv-subhero h1 {
  font-size: clamp(52px, 7.2vw, 110px);
  margin: 0;
  max-width: 990px;
}

.mv-hero-copy,
.mv-subhero p:not(.mv-kicker) {
  color: rgba(52, 49, 44, 0.78);
  font-size: clamp(17px, 1.8vw, 22px);
  line-height: 1.7;
  margin: 0;
  max-width: 560px;
}

.mv-hero-copy {
  grid-column: 2;
}

.mv-hero-plate {
  background:
    linear-gradient(90deg, rgba(255, 255, 255, 0.24) 1px, transparent 1px) 0 0 / 84px 84px,
    linear-gradient(145deg, #cfc3b2 0%, #9d917f 45%, #e3dacb 100%);
  border: 1px solid var(--mv-border);
  bottom: 0;
  box-shadow: var(--mv-shadow);
  height: clamp(220px, 28vw, 390px);
  position: absolute;
  right: max(24px, calc((100vw - 1120px) / 2));
  width: min(28vw, 390px);
  z-index: 1;
}

.mv-hero-plate::before,
.mv-image-plate::before {
  border: 1px solid rgba(32, 32, 28, 0.18);
  content: "";
  inset: 11%;
  position: absolute;
}

.mv-hero-plate::after {
  background: rgba(246, 241, 232, 0.34);
  bottom: 14%;
  content: "";
  height: 24%;
  left: 14%;
  position: absolute;
  width: 58%;
}

.mv-hero-plate span {
  bottom: 18px;
  color: rgba(32, 32, 28, 0.56);
  font-size: 11px;
  left: 18px;
  letter-spacing: 0.12em;
  position: absolute;
  text-transform: uppercase;
}

.mv-split {
  align-items: start;
  display: grid;
  gap: clamp(34px, 7vw, 90px);
  grid-template-columns: minmax(230px, 0.72fr) minmax(280px, 1fr);
}

.mv-split h2,
.mv-section-head h2,
.mv-inquiry-grid h2 {
  font-size: clamp(42px, 6vw, 86px);
  margin: 12px 0 0;
}

.mv-narrative p,
.mv-method p,
.mv-inquiry-grid aside p {
  color: rgba(52, 49, 44, 0.78);
  font-size: clamp(18px, 2vw, 24px);
  line-height: 1.72;
  margin: 0 0 24px;
}

.mv-philosophy {
  background: var(--mv-paper);
  border-bottom: 1px solid var(--mv-border);
  border-top: 1px solid var(--mv-border);
}

.mv-section-head {
  display: grid;
  gap: 18px;
  grid-template-columns: 0.72fr 1.28fr;
  margin-bottom: clamp(40px, 8vw, 92px);
}

.mv-section-head h2 {
  margin: 0;
}

.mv-gallery-preview {
  align-items: end;
  display: grid;
  gap: clamp(24px, 5vw, 70px);
  grid-template-columns: 1fr 0.78fr;
}

.mv-project-card {
  margin: 0;
}

.mv-image-plate {
  background:
    repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.16) 0 1px, transparent 1px 38px),
    linear-gradient(140deg, var(--plate-a), var(--plate-b));
  border: 1px solid var(--mv-border);
  box-shadow: var(--mv-shadow);
  min-height: clamp(330px, 42vw, 560px);
  overflow: hidden;
  position: relative;
}

.mv-image-plate::after {
  background: rgba(246, 241, 232, 0.28);
  border: 1px solid rgba(32, 32, 28, 0.12);
  content: "";
  height: 32%;
  position: absolute;
  right: 10%;
  top: 18%;
  width: 34%;
}

.mv-project-card figcaption {
  align-items: baseline;
  display: flex;
  gap: 14px;
  justify-content: space-between;
  padding-top: 16px;
}

.mv-project-card span {
  color: var(--mv-charcoal);
  font-family: "Cormorant Garamond", Georgia, serif;
  font-size: clamp(24px, 2.8vw, 36px);
}

.mv-project-card em {
  color: rgba(52, 49, 44, 0.56);
  font-style: normal;
  text-align: right;
}

.mv-offset-low {
  transform: translateY(34px);
}

.mv-offset-high {
  transform: translateY(-46px);
}

.mv-wide {
  grid-column: 1 / -1;
  margin-left: clamp(64px, 12vw, 170px);
}

.mv-wide .mv-image-plate {
  min-height: clamp(300px, 32vw, 430px);
}

.mv-plate-stone { --plate-a: #d9d1c2; --plate-b: #a99b87; }
.mv-plate-walnut { --plate-a: #8b725e; --plate-b: #d7cdbd; }
.mv-plate-linen { --plate-a: #eee8dc; --plate-b: #b8ad9b; }
.mv-plate-plaster { --plate-a: #e5ded1; --plate-b: #c6bba9; }
.mv-plate-charcoal { --plate-a: #3c3a34; --plate-b: #b2a795; }
.mv-plate-brass { --plate-a: #b3976f; --plate-b: #efe4d2; }

.mv-subhero {
  background: var(--mv-paper);
  border-bottom: 1px solid var(--mv-border);
  padding: clamp(36px, 5vw, 58px) 0 clamp(82px, 10vw, 128px);
}

.mv-subnav {
  align-items: center;
  display: flex;
  justify-content: space-between;
  margin-bottom: clamp(78px, 10vw, 132px);
}

.mv-subhero .mv-kicker {
  margin-bottom: 18px;
}

.mv-subhero p:not(.mv-kicker) {
  margin-top: 28px;
}

.mv-masonry {
  align-items: start;
  display: grid;
  gap: clamp(28px, 4vw, 56px);
  grid-template-columns: repeat(6, 1fr);
}

.mv-masonry .mv-project-card {
  grid-column: span 3;
}

.mv-masonry .mv-tall .mv-image-plate {
  min-height: clamp(520px, 56vw, 760px);
}

.mv-masonry .mv-wide-card {
  grid-column: span 4;
  margin-left: clamp(40px, 7vw, 100px);
}

.mv-service-list {
  display: grid;
  gap: 0;
}

.mv-service-item {
  border-top: 1px solid var(--mv-border);
  display: grid;
  gap: clamp(24px, 5vw, 74px);
  grid-template-columns: 120px minmax(0, 1fr);
  padding: clamp(34px, 5vw, 64px) 0;
}

.mv-service-item:last-child {
  border-bottom: 1px solid var(--mv-border);
}

.mv-service-item:nth-child(even) {
  padding-left: clamp(0px, 12vw, 180px);
}

.mv-service-item h2 {
  font-size: clamp(36px, 5vw, 72px);
  margin: 0 0 18px;
}

.mv-service-item p {
  color: rgba(52, 49, 44, 0.78);
  font-size: clamp(17px, 1.8vw, 21px);
  margin: 0;
  max-width: 710px;
}

.mv-method {
  background: var(--mv-paper);
  border-top: 1px solid var(--mv-border);
}

.mv-inquiry-grid {
  align-items: start;
  display: grid;
  gap: clamp(34px, 8vw, 104px);
  grid-template-columns: minmax(260px, 0.74fr) minmax(320px, 1fr);
}

.mv-inquiry-form {
  border-top: 1px solid var(--mv-border);
  display: grid;
  gap: 26px;
  padding-top: 10px;
}

.mv-inquiry-form label,
.mv-inquiry-form fieldset {
  border: 0;
  display: grid;
  gap: 10px;
  margin: 0;
  padding: 0;
}

.mv-inquiry-form span,
.mv-inquiry-form legend {
  color: var(--mv-taupe);
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.16em;
  text-transform: uppercase;
}

.mv-inquiry-form input,
.mv-inquiry-form select,
.mv-inquiry-form textarea {
  appearance: none;
  background: transparent;
  border: 0;
  border-bottom: 1px solid var(--mv-border);
  border-radius: 0;
  color: var(--mv-charcoal);
  font: 300 18px/1.6 "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  padding: 10px 0 14px;
  width: 100%;
}

.mv-inquiry-form input:focus,
.mv-inquiry-form select:focus,
.mv-inquiry-form textarea:focus {
  border-color: var(--mv-charcoal);
  outline: none;
}

.mv-inquiry-form fieldset label {
  align-items: center;
  color: rgba(52, 49, 44, 0.78);
  display: flex;
  flex-direction: row;
  font-size: 16px;
  gap: 12px;
}

.mv-inquiry-form input[type="checkbox"] {
  accent-color: var(--mv-charcoal);
  height: 16px;
  width: 16px;
}

.mv-inquiry-form button {
  align-items: center;
  background: var(--mv-charcoal);
  border: 1px solid var(--mv-charcoal);
  color: var(--mv-paper);
  cursor: pointer;
  display: inline-flex;
  font: 500 12px/1 "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  justify-content: center;
  letter-spacing: 0.14em;
  min-height: 52px;
  padding: 0 28px;
  text-transform: uppercase;
  transition: background 180ms ease, color 180ms ease;
  width: fit-content;
}

.mv-inquiry-form button:hover,
.mv-inquiry-form button:focus-visible {
  background: transparent;
  color: var(--mv-charcoal);
}

@media (max-width: 820px) {
  :root {
    --mv-max: min(100vw - 30px, 680px);
  }

  .mv-nav,
  .mv-project-card figcaption {
    align-items: flex-start;
    flex-direction: column;
  }

  .mv-nav {
    gap: 18px;
    padding-top: 26px;
  }

  .mv-subnav {
    align-items: flex-start;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 64px;
  }

  .mv-menu {
    justify-content: flex-start;
    gap: 12px 18px;
  }

  .mv-hero-grid,
  .mv-split,
  .mv-section-head,
  .mv-gallery-preview,
  .mv-inquiry-grid {
    grid-template-columns: 1fr;
  }

  .mv-hero {
    min-height: auto;
    padding-bottom: 78px;
  }

  .mv-hero-grid {
    gap: 22px;
    margin-top: clamp(44px, 12vw, 64px);
  }

  .mv-hero h1 {
    font-size: clamp(43px, 12.6vw, 56px);
  }

  .mv-subhero h1 {
    font-size: clamp(46px, 14vw, 70px);
  }

  .mv-hero-copy {
    grid-column: auto;
  }

  .mv-hero-plate {
    height: 180px;
    margin: 32px auto 0;
    position: relative;
    right: auto;
    width: var(--mv-max);
  }

  .mv-offset-low,
  .mv-offset-high {
    transform: none;
  }

  .mv-wide,
  .mv-masonry .mv-wide-card {
    grid-column: auto;
    margin-left: 0;
  }

  .mv-masonry {
    grid-template-columns: 1fr;
  }

  .mv-masonry .mv-project-card {
    grid-column: auto;
  }

  .mv-service-item,
  .mv-service-item:nth-child(even) {
    gap: 10px;
    grid-template-columns: 1fr;
    padding-left: 0;
  }
}
CSS;

if (function_exists('wp_update_custom_css_post')) {
    wp_update_custom_css_post($customCss, ['stylesheet' => get_stylesheet()]);
} else {
    $existingCss = wp_get_custom_css_post(get_stylesheet());
    $cssPost = [
        'post_content' => $customCss,
        'post_title' => get_stylesheet(),
        'post_name' => get_stylesheet(),
        'post_type' => 'custom_css',
        'post_status' => 'publish',
    ];
    if ($existingCss) {
        $cssPost['ID'] = $existingCss->ID;
        wp_update_post($cssPost);
    } else {
        wp_insert_post($cssPost);
    }
}

foreach ($pageIds as $key => $id) {
    $preview = get_preview_post_link($id);
    printf("%s\t%d\t%s\t%s\n", $key, $id, get_edit_post_link($id, ''), $preview ?: get_permalink($id));
}
