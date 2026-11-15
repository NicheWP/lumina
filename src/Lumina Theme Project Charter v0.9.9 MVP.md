# Lumina Theme Project Charter v0.9.9 MVP  
  
# Section 1: Project Vision & Features  
  
## 1.1 Project Vision: Modern Full-Site Editing  
Lumina represents a modern evolution of WordPress Full-Site Editing (FSE). Inspired by the colors, ambient light, and natural depth of the physical environment around us, Lumina bridges organic aesthetics with high-performance digital web architecture. We believe website layouts should feel balanced, tactile, and natural—bringing the structural rhythms and light behavior of the physical world directly onto the digital canvas. Anchored around an MVP showcase for high-end **Photography Studios**, Lumina demonstrates how responsive grid reflows, dark monochromatic glass aesthetics, and kinetic physics elevate visual storytelling.  
##   
## 1.2 Dynamic Moods & Global Style Flexibility  
Global Style variations in Lumina go far beyond superficial color swaps or font changes. Powered by modular theme.jsonstyle variations, Lumina enables site creators to instantly transform the entire physical personality, spatial geometry, and kinetic energy of a site with a single click in the Site Editor. Rather than applying static rules, each **Lumina Mood** re-engineers the site's structural physics, corner radii, spatial gaps, and motion easing curves:  
* **Architectural & Weighted (*Lumina Gallery*):** Designed for high-end exhibition spaces and editorial layouts. Features sharp, architectural 6px corners, structured 30px layout gaps, and luxurious, deliberate animation curves (cubic-bezier(0.2, 0, 0, 1) with up to 800ms transitions) that give interactive elements a weighted, physical presence.  
* **High-Performance & Precision (*Lumina Tactical*):** Tailored for utility, speed, and dense information architecture. Employs rugged 9px corner radii, compact 20px layout gaps, and crisp, rapid animation response times (180ms–300ms) for near-instantaneous user feedback.  
* **Fluid & Organic (*Lumina Spacious*):** An ultra-modern, fluid mood. Introduces soft 30px "pebble" corner radii, pill buttons (999px), expansive 34px layout gaps, and playful spring physics (cubic-bezier(0.34, 1.56, 0.64, 1)) where cards and buttons expand dynamically on interaction.  
* **Static & Motion-Free (*Lumina Static* / 500-static.json):** A zero-kinetic style variation designed for accessibility and pure typographic focus. Disables all physical hover transforms (hoverTransform: "none") site-wide while safely falling back to elegant, static hover opacity shifts.  
##   
## 1.3 Ambient Light & Organic Depth  
Lumina captures the natural depth of physical surroundings to make content layouts completely intuitive. By structuring blocks to mimic how ambient light and shadow cast subtle gradients across architectural spaces, text, images, and container blocks interact within a visual ecosystem that feels native to the eye.  
##   
## 1.4 Beautiful Colors & Smart Color Logic  
Colors in Lumina operate on a sophisticated semantic engine—utilizing calibrated mid-tones, deep dark anchors, and subtle backdrops that give site creators the flexibility to direct user attention exactly where it belongs.  
* **Automated Color Contrast Engine:** Lumina eliminates the need to manually tweak layout styling panel parameters in the block editor.  
* **Gutenberg Palette Purge:** To keep the Site Editor UI ultra-clean, raw non-semantic palette swatches (black, white, foreground-alt, and unmapped color names) are purged from selectable color pickers, exposing strictly functional semantic swatches (primary, secondary, tertiary, base, contrast, etc.).  
* **48% / 38% HSL Lightness Calibration:** Core palette tracks strictly enforce a mathematically unified lightness architecture—maintaining ~48% lightness on primary action anchors for high-impact CTAs and ~38% lightness on dark alt anchors for rich, non-muddy container depth.  
* **Dynamic Background Perception:** The theme engine automatically tracks background color selections and calculates WCAG AA-compliant default colors for body copy, major headlines, and navigation links.  
* **Zero-Touch Readability:** Site builders can simply drop element blocks into any section and select a tint layout; the theme manages legibility and contrast automatically.  
##   
## 1.5 Interactive Depth & Kinetic Physics  
Lumina establishes an active layout track that users can actually feel:  
* **Automated Card Detection:** Container blocks carrying interactive elements—such as action buttons or links—are automatically detected by the theme logic.  
* **Kinetic Lift-Off:** Detected interactive cards gently lift off the page with soft, realistic ambient shadows.  
* **Mood-Engineered Motion:** Hover scales (ranging from conservative 1.02× scale up to elastic 1.08× expansion) and y-axis displacement tokens (translateY(-3px) to translateY(-5px)) adapt dynamically to the active Global Style Mood.  
* **Decoupled Opacity Tokens:** Interaction feedback is cleanly decoupled across element roles—inline links pull custom.color.link.hoverOpacity (0.7), linked images pull custom.color.image.hoverOpacity (1.0 in motion, 0.85 static), and buttons retain solid fill integrity (1.0) while scaling.  
* **Omni-Input Responsiveness:** Cards respond instantly to mouse hovers and mobile touch gestures alike, drawing closer to the user to signify action readiness.  
##   
## 1.6 Full Editor Freedom (WordPress FSE Philosophy)  
Lumina delivers complete layout control without technical hurdles or cascade pollution:  
* **Modular Assembly:** Easily switch custom site headers, personalized footers, visual article grids, and global style variations directly within a unified Site Editor setup.  
* **Adaptable & Showcase Ready:** Layout components and template parts can be swapped periodically to keep the site modern and fresh, optimized out-of-the-box for photography portfolios, editorial magazines, and studio showcases.  
  
# Section 2: Lumina Color Engine & Master Palette Architecture  
##   
## 2.1 The Four-Tier Color Track & Lightness Architecture  
Every chromatic family in Lumina (Sage, Ocean Slate, Antique Gold, Terracotta, Velvet, Zinc) is mathematically calibrated into a four-tier track structure that strictly enforces a 48%/38% HSL lightness standardization:  
  
1. **Primary Tier (48% Lightness Anchor):** The core brand anchor used for high-impact callout fills, primary CTA buttons, and key focus indicators. Formulated for high-contrast white or off-white typography.  
2. **Alt Tier / Primary Alt (38% Lightness Anchor):** A deeper dark anchor used for hover states, focused button outlines, and dark hero container backgrounds.  
3. **Subtle Tier (91%–96% Lightness Wash):** A soft, chromatic backdrop designed for container wells, alert boxes, and highlighted group backgrounds.  
4. **Subtle Alt Tier (83%–88% Lightness Seam):** An alternate tinted backdrop used for nested wells, alternating table rows, card borders, and structural dividers.  
**High-Key Ethereal Mode (500-light.json)**  
In high-key light variations, the primary, secondary, and tertiary slots shift into soft 91%–95% card fills that pair with dark contrast text, while their corresponding -alt anchors step up to 44%–48% flagship action controls to preserve brand vibrancy without plunging the layout into heavy dark navy or pine.  
  
**Brand-Grounded Dark Floors**  
Dark mode containers and abyssal background floors (primary-dark, dark, tertiary-dark, dark-alt) strictly carry brand-tinted HSL hues (18%–22% lightness floors) rather than generic black or flat carbon wells.  
  
## 2.2 Scheme-Specific Tinted Black Calibration  
To prevent dark surfaces and deep typography from feeling cold or unintegrated, Lumina eliminates sterile achromatic grays. The almost-black (18% lightness floor) and not-quite-black (11% lightness typographic ink) tokens dynamically rotate their HSL hue angles to lock directly into the active color scheme's contrast identity:  
  
* **Velvet Scheme:** Rotated to a 327° HSL Plum hue (hsl(327, 14%, 18%) for almost-black and hsl(330, 8%, 11%) for not-quite-black) to give dark cards and deep text a plum-infused charcoal depth.  
* **Light / Obsidian Scheme:** Rotated to a 215° HSL Obsidian Slate hue (hsl(215, 16%, 18%) for almost-black and hsl(215, 15%, 11%) for not-quite-black) to match the contrast typographic ink token.  
* **Heritage / Zinc Schemes:** Rotated to a 208° HSL Slate hue to align with cold charcoal and technical aqua backgrounds.  
## 2.3 The Neutral & Warm Sand Track  
To prevent layout wells, sidebars, and footers from drifting into cold digital gray, Lumina anchors all neutral utilities on a warm sand and linen track (32°–40° HSL baseline):  
* **base / off-white (97.5%–99% Lightness):** Master viewport canvas background for light mode variations.  
* **neutral (96% Lightness):** Warm linen component well—the lightest non-canvas structural surface for off-canvas drawers and sidebar panels.  
* **very-light-gray (93% Lightness):** Warm sand background fill for primary footers, sub-footers, and secondary content wells.  
* **neutral-alt (88% Lightness):** Default warm sand border seam and field outline stroke.  
* **light-gray (85% Lightness):** Inner inset wells and subtle separator lines.  
* **gray (71% Lightness):** Medium-contrast structural borders and hairline seams.  
* **dark-gray (44% Lightness):** Muted secondary typography, post metadata, captions, and secondary labels.  
* **very-dark-gray (25% Lightness):** Deep ambient shadow parameter tint and high-contrast neutral elements.  
* **contrast (11%–13% Lightness):** Deep obsidian/indigo typographic ink for H1–H6 headings and body copy on light backdrops.  
## 2.4 Dynamic CSS Filter Link Engine & Interaction Mechanics  
Lumina utilizes a dynamic, filter-driven link transformation engine that evaluates contrast and hue relationships relative to the underlying surface fill rather than relying on hardcoded static colors.  
  
**Variable Abstraction & Purpose**  
* **$filter-link-lighten:** Binds to var(--wp--custom--color--highlight-alt--lighten, brightness(1.75) saturate(0.80)). Provides dynamic, relative brightening and saturation adjustments for inline link text sitting over dark -alt background slots and dark containers.PNG+ 1  
* **$filter-link-darken:** Binds to var(--wp--custom--color--highlight--darken, brightness(0.40) saturate(1.15)). Provides dynamic, relative darkening transforms for link text rendered over light background slots and light surface fills.PNG+ 1  
**Scheme-Specific Filter Customization**  
Each theme.json style variation can supply scheme-specific filter overrides under settings.custom.color (e.g., fine-tuning highlight-alt.lighten in Ember or Light variants). This allows individual color schemes to achieve optimal WCAG AA legibility and eliminate chromatic glare without modifying SCSS engine logic or breaking global cascade rules.  
  
**Decoupled Role Opacity Tokens**  
Interaction feedback is strictly isolated across component roles to prevent layout reflow and visual interference:  
  
* **Inline Text Links:** Controlled via custom.color.link.hoverOpacity (locked to 0.7 for sharp alpha feedback without obscuring text).MD  
* **Linked Media Assets:** Controlled via custom.color.image.hoverOpacity (0.85 static / 1.0 in motion).MD  
* **Buttons:** Retain solid fill opacity (1.0) and handle hover feedback via 15% dark overlay pseudo-elements (::before) or scale transformations.MD  
## 2.5 Gutenberg UI Safety Protocols & Palette Purge  
**The Gutenberg Palette Purge**  
To keep the Site Editor inspector clean and prevent content creators from applying un-tinted raw colors, non-semantic palette swatches (black, white, foreground-alt, and raw named colors) are purged from selectable color pickers in theme.json. The editor exposes strictly functional, semantic swatches (primary, secondary, tertiary, base, contrast, neutral, neutral-alt, highlight, highlight-alt, etc.).  
  
**The currentColor Exclusion Protocol**  
Dynamic or contextual properties like --wp--custom--color--muted-text must **NEVER** be registered as selectable color dots in theme.json:  
  
1. **Inverted Dot Bug:** Gutenberg's sidebar applies its own text context, causing circular palette dots using currentColorto display incorrect admin preview colors.MD  
2. **Background Feedback Loop:** Applying currentColor as a container background matches the fill to the text color, rendering all content instantly invisible.MD  
3. **Implementation Standard:** Contextual properties are injected exclusively via developer-controlled CSS custom properties in :where(.wp-site-blocks).MD  
## 2.6 Theme Interoperability Bridge (_theme-bridge.scss)  
To ensure seamless integration when importing external pattern layouts (such as TwentyTwentyFour, TwentyTwentyFive, or Flat Blocks), Lumina provides a universal mapping bridge:  
  
* **Automated Translation Loop:** An @each Sass loop maps external class utilities (e.g., .has-tertiary-color, .has-heading-color, .has-accent-background-color) directly into Lumina's 5-tier semantic token architecture.  
* **Zero-Specificity Safety Net:** Unrecognized or legacy block markup falls back to zero-specificity :where() selectors, guaranteeing that imported patterns inherit correct theme typography, link colors, and contrast rules without specificity wars or requiring !important flags.  
## 2.7 Master Semantic Color Matrix Table  

| Semantic Token / Custom Property | HSL Target / Asset Mapping | Functional Purpose & Architectural Role | Contextual Contrast & Behavioral Rule |
| -------------------------------- | --------------------------------------------------- | --------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| primary | hsl(154, 24%, 48%)(Main)

hsl(154, 22%, 92%)(Light) | Primary brand callout fill, main CTA buttons, and key visual focal points.
MD | Pairs with white text on dark surfaces or contrast ink on high-key light fills.
MD |
| secondary | hsl(206, 24%, 44%)(Main)

hsl(206, 22%, 92%)(Light) | Secondary action buttons, info cards, active navigation markers, and hero section accents.
MD | Formulated for solid container fills and secondary control hierarchy.
MD |
| tertiary | hsl(34, 32%, 48%)(Main)

hsl(38, 24%, 92%)(Light) | Warm accent highlights, heading separators, featured tags, and quote borders.
MD | Binds decorative accents to the warm brand track.
MD |
| primary-alt | hsl(154, 26%, 38%)(Main)

hsl(154, 24%, 48%)(Light) | Hover/active states for primary CTAs, dark container headers, and elevated card bounds.
MD | Grounded dark anchor; pairs strictly with white/off-white text.
MD |
| secondary-alt | hsl(206, 26%, 34%)(Main)

hsl(206, 24%, 44%)(Light) | Hero section backgrounds, default card header wells, and dark container fills.
MD | Darker than secondary across all schemes; default background for hero patterns.
MD |
| tertiary-alt | hsl(34, 34%, 38%)(Main)

hsl(34, 32%, 48%)(Light) | Hover/active states for warm accents, deep badges, and warm card headers.
MD | Deep warm anchor for high-impact accent sections.
MD |
| primary-subtle | hsl(154, 20%, 91%) | Faint sage background wash for primary card wells and success callouts.
MD | Always pairs with dark typographic ink (contrast).
MD |
| secondary-subtle | hsl(206, 24%, 91%) | Faint sky background wash for info boxes and secondary card containers.
MD | Always pairs with dark typographic ink (contrast).
MD |
| tertiary-subtle | hsl(38, 22%, 91%) | Faint parchment wash for warning banners and editorial excerpts.
MD | Always pairs with dark typographic ink (contrast).
MD |
| primary-subtle-alt | hsl(154, 18%, 88%) | Structural hairline borders and card seams surrounding primary subtle wells.
MD | Subtle structural framing token.
MD |
| secondary-subtle-alt | hsl(206, 18%, 87%) | Structural hairline borders and card seams surrounding secondary subtle wells.
MD | Subtle structural framing token.
MD |
| tertiary-subtle-alt | hsl(38, 20%, 88%) | Structural hairline borders and field outlines surrounding tertiary subtle wells.
MD | Subtle structural framing token.
MD |
| highlight | hsl(154, 65%, 68%)(Main)

hsl(154, 65%, 40%)(Light) | High-chroma link ink, focus rings, and active indicators on dark backgrounds.
MD | Electric link glow; assigned when container text is light.
PNG+ 1 |
| highlight-alt | hsl(154, 75%, 28%)(Main)

hsl(154, 55%, 30%)(Light) | High-chroma link ink for light, text-heavy container layouts without forced underlines.
MD | Deep link ink; assigned when container text is dark.
PNG+ 1 |
| base | hsl(0, 0%, 99%) | Primary canvas background color anchoring global layout wrappers.
MD | Master light viewport canvas.
MD |
| contrast | hsl(215, 20%, 13%) | Primary typographic ink for body copy, H1–H6 headings, and core UI text.
MD | High-contrast reading ink (WCAG AAA).
MD |
| neutral | hsl(40, 20%, 96%) | Warm linen background well for sidebars, off-canvas drawers, and unaccented cards.
MD | Lightest non-canvas structural fill well.
MD |
| neutral-alt | hsl(40, 15%, 88%) | Default neutral border stroke for dividers, field outlines, and standard card borders.
MD | Structural framing seam (~8%–12% contrast).
MD |
| very-light-gray | hsl(40, 18%, 93%) | Warm sand background fill for primary footers, sub-footers, and secondary wells.
MD | Outer footer floor canvas.
MD |
| light-gray | hsl(40, 14%, 85%) | Inner wells, search input backgrounds, and subtle content separator lines.
MD | Secondary footer well and inner field fill.
MD |
| gray | hsl(40, 8%, 71%) | Medium-contrast structural borders, disabled controls, and form outlines.
MD | Structural hairline seam.
MD |
| dark-gray | hsl(40, 4%, 44%) | Muted secondary typography, post metadata, captions, and secondary labels.
MD | Secondary typographic ink.
MD |
| very-dark-gray | hsl(40, 2%, 25%) | Deep shadow parameter tint and high-contrast neutral elements.
MD | Ambient shadow tint parameter.
MD |
| almost-black | hsl(215, 16%, 18%)(Scheme-calibrated) | High-contrast dark surface fill, dark mode cards, and carbon footer grounds.
MD | Hue-rotated to match scheme contrast identity (18% L).
PNG+ 2 |
| not-quite-black | hsl(215, 15%, 11%)(Scheme-calibrated) | Deep typographic ink for high-contrast reading surfaces and abyssal accents.
MD | Hue-rotated to match scheme contrast identity (11% L).
PNG+ 2 |
  
****2.8 Colors-Related theme.json Custom Variables****  
All component-level color references in Lumina are abstracted into settings.custom.color tokens in theme.json to isolate core styling logic from editable palette presets.  
MD  
  
**2.8.1 Structural Custom Property Map**  
JSON  
  
```
{
  "settings": {
    "custom": {
      "color": {
        "theme": {
          "mode": "is-light-theme",
          "scheme": "lumina"
        },
        "border": "color-mix(in srgb, currentColor 8%, transparent)",
        "field": {
          "outline": "color-mix(in srgb, currentColor 12%, transparent)"
        },
        "highlight": {
          "darken": "brightness(0.40) saturate(1.15)"
        },
        "highlight-alt": {
          "lighten": "brightness(1.75) saturate(0.80)"
        },
        "button": {
          "background": "var(--wp--preset--color--primary)",
          "text": "var(--wp--preset--color--off-white)",
          "hover": "var(--wp--preset--color--primary-alt)",
          "hoverOpacity": "1.0"
        },
        "link": {
          "hoverOpacity": "0.7"
        },
        "image": {
          "hoverOpacity": "0.85"
        },
        "heading": {
          "text": "var(--wp--preset--color--contrast)",
          "separator": "var(--wp--preset--color--tertiary)"
        },
        "navigation": {
          "background": "var(--wp--preset--color--base)"
        }
      }
    }
  }
}

```
  
**2.8.2 Token Definition & Behavior Matrix**  

| Variable Key | Target Preset / Value | Architectural Mechanics & Purpose |
| ---------------------------------- | ------------------------------------------------- | -------------------------------------------------------------------------------- |
| custom.color.theme.mode | "is-light-theme" / "is-dark-theme" | Global state flag set on <body> to route theme physics and contrast cascades.
MD |
| custom.color.theme.scheme | "lumina", "ember", "velvet", "zinc", "light" | Identifies active Global Style scheme variation.
MD |
| custom.color.border | color-mix(in srgb, currentColor 8%, transparent) | Dynamic, context-aware stroke for cards, fields, and dividers. |
| custom.color.field.outline | color-mix(in srgb, currentColor 12%, transparent) | Context-aware focus outline for form inputs.
MD |
| custom.color.highlight.darken | var(--wp--custom--color--highlight--darken) | SCSS $filter-link-darken variable hook for link darkening logic.
PNG |
| custom.color.highlight-alt.lighten | var(--wp--custom--color--highlight-alt--lighten) | SCSS $filter-link-lighten variable hook for link brightening logic.
PNG |
| custom.color.button.background | var(--wp--preset--color--primary) | Surface fill for core/button blocks.
MD |
| custom.color.button.hoverOpacity | 1.0 (with 15% dark overlay ::before) | Tactile hover feedback for buttons without color shifting.
MD |
| custom.color.link.hoverOpacity | 0.7 | Alpha transparency shift for text links on hover without layout reflow.
MD |
| custom.color.image.hoverOpacity | 0.85 | Hover opacity shift for linked image assets. |
| custom.color.heading.text | var(--wp--preset--color--contrast) | Default typographic ink for H1–H6 headings.
MD |
| custom.color.heading.separator | var(--wp--preset--color--tertiary) | Decorative underline accent color for entry titles.
MD |
| custom.color.navigation.background | var(--wp--preset--color--base) | Backdrop fill for sticky header navigation wrappers.
MD |
  
  
# Section 3: Digital Physics & Kinetic Effects Engine  
## 3.1 Architecture Overview & Block Registry Schema (_00-config.scss)  
The Lumina Physics Engine operates as a declarative, data-driven kinetic framework. Rather than applying loose, uncoordinated CSS hover rules, all interactive components are declared within a centralized Map Registry (_00-config.scss). This registry maps WordPress Gutenberg blocks to physical roles, structural gates, and interaction scopes.  
  
**Centralized Block Registry Schema**  
Every block entry merges with programmatic system defaults ($registry-defaults) via map.merge() to guarantee structural consistency across theme styles:  
  
SCSS  
  
```
// Default Registry Configuration Map
$registry-defaults: (
    block:   '*',            // Base block selector or wildcard [class*="wp-block-"]
    is:      'none',         // Mandatory CSS class filters (e.g., .has-background)
    has:     'a, button',    // Required structural child gate (e.g., embedded links)
    exclude: '.alignfull',   // Excluded container contexts (e.g., full-width sections)
    trigger: 'self',        // Action boundary selector
    target:  'self',        // Kinetic animation target selector
    spacing: false,         // Structural spacing override flag
    role:    'object'       // Role classification: card | object | object-zoom | object-grow | button
);

```
  
**Registry Manifest Mapping Table**  

| Block Target | Structural Filter (is) | Required Gate (has) | Trigger / Target | Assigned Role | Architectural Behavior |
| ----------------------------------------------- | ---------------------------------- | --------------------------------------- | ---------------------------- | ------------- | -------------------------------------------------------------------------------------- |
| Wildcard Container (*) | Backgrounds, Custom Borders, Cover | a:not(figcaption a), .wp-element-button | self / self | card | Kinetic container with subtle lift (translateY(-3px)) and ambient shadow elevation.
MD |
| Core Image (.wp-block-image) | none | a:not(figcaption a) | self / img | object | Standard linked media figure with depth shadow lift.
MD |
| Column Image (.wp-block-column .wp-block-image) | none | a:not(figcaption a) | self / img | object-zoom | Bounded zoom portal framed within column geometry.
MD |
| Media & Text (.wp-block-media-text__media) | none | a:not(figcaption a) | self / img | object-zoom | Framed viewport zoom with overflow containment.
MD |
| Sovereign Buttons (*) | none | none | .wp-element-button / self | button | Tier-30 sovereign control with primary scale expansion (scale(1.08)).
MD |
| Social Links (.wp-block-social-links) | none | none | .wp-block-social-link / self | button | Micro-interaction button logic.
MD |
  
****3.2 Specificity Governance & Dynamic Compilation (_01-compiler.scss)****  
To eliminate specificity wars and prevent structural usage of !important, the engine uses compile-selector() to compile clean, mathematically predictable CSS selectors.  
  
****compile-selector Evaluation Pipeline****  

| Pipeline Step | Target Parameter | Logic & Output Mechanism | Compiled Output Example |
| -------------------------- | ----------------- | --------------------------------------------------------------------------------------------------- | ---------------------------------- |
| 1. Base Initialization | $block | Adds specified block selector or injects the global wildcard [class*="wp-block-"] if unassigned.
MD | [class*="wp-block-"]

MD |
| 2. Exclusion Gate | $exclude | Appends :not() structural exclusions unless the role is set to button.
MD | :not(.alignfull)

MD |
| 3. Modifier Filter | $is | Appends clean class filters via :is() pseudo-class wrappers.
MD | :is(.has-background)

MD |
| 4. Link Gate | $has | Injects required descendant checks using :has().
MD | :has(a)

MD |
| 5. Pseudo-State Injection | $scope | Injects :hover or accessible keyboard focus gates (:has(:focus-visible)).
MD | :hover or :has(:focus-visible)

MD |
| 6. Scope & Target Assembly | $trigger, $target | Assembles final path evaluating whether triggers and targets are self-contained or nested.
MD | [class*="wp-block-"]:hover img

MD |
  
**Programmatic Specificity Scores**  
SCSS  
  
```
// Tier 10: Baseline Object Target (Score: 0,1,0)
.wp-block-image:where(:not(.alignfull)) img

// Tier 20: Kinetic Card Container (Score: 0,2,0)
[class*="wp-block-"]:not(.alignfull):is(.has-background)

// Tier 21: Card Floor Wildcard (Score: 0,2,1)
[class*="wp-block-"]:not(.alignfull):is(.has-background) [class*="wp-block-"]

// Tier 30: Sovereign Control (Score: 0,3,0)
.wp-site-blocks .wp-element-button

```
##   
## 3.3 Two-Phase Build Architecture & Execution Tracks  
The engine compiles into two separate stylesheets to isolate static structural styles from interactive kinetics:  
  
1. **Phase 1: Resting Geometry (lumina-engine.css / $interactive: false):** Establishes layout bounds, radii, baseline transforms (translateY(0) scale(1)), and resting shadows.  
2. **Phase 2: Active Kinetics (lumina-interactions.css / $interactive: true):** Handles hover (:hover) and keyboard focus (:has(:focus-visible)) transforms, shadow shifts, and veil reveals.  
**Execution Track Authority Matrix**  

| Track | Authority Tier | Role Key | Active Kinetics & Transforms | Default Shadow Level | Scope & Element Types |
| --------- | --------------------- | ----------- | -------------------------------------------------------- | --------------------------------------------- | ----------------------------------------------------------------------------- |
| Track A | Tier 30 (Sovereign) | button | Large scale expansion (scale(1.08))
MD | $shadow-high (0 8px 16px rgba(0,0,0,0.15))
MD | Core buttons, avatars, social links, tag clouds, form submits.
MD |
| Track B.1 | Tier 11–12 (Elevated) | object-zoom | Static outer frame; inner asset expands (scale(1.08))
MD | Outer wrapper receives $shadow-deep

MD | Column images, Media & Text frames, custom image viewports.
MD |
| Track B.2 | Tier 11–12 (Elevated) | object-grow | Subtle image expansion (scale(1.03))
MD | Direct asset receives $shadow-deep

MD | Gallery images, post featured media figures.
MD |
| Track B.3 | Tier 10 (Baseline) | object | Vertical displacement lift (translateY(-4px))
MD | Direct asset receives $shadow-deep

MD | Standalone linked images, standard content figures.
MD |
| Track C | Tier 20 (Container) | card | Subtle container lift (translateY(-3px))
MD | Container receives $shadow-deep

MD | Group blocks, columns, and layout wells with background or custom borders.
MD |
  
  
****3.4 Passenger-Zoom Mechanics & Structural Isolation (_02-resting.scss & _03-actions.scss)****  
Media blocks assigned to the object-zoom role (such as column images and Media & Text blocks) enforce strict isolation between outer container visual styling and inner graphic scale transforms.  
  

| Structural Layer | Key CSS Properties & Mixins | Mechanical Behavior & Function |
| ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Outer Visual Perimeter | %physics-zoom-wrapper-visuals

• border-radius: var(--wp--custom--border--radius)

• border: 1px solid var(--wp--custom--color--border)

• padding: var(--wp--preset--spacing--20)

• @include __blueprint-shadow-natural | Holds static visual container bounds (borders, default shadows, padding). Strips borders/padding from internal media so layout geometry remains unclipped.
MD+ 1 |
| Clipped Viewport Anchor | %physics-zoom-wrapper-clipped

• position: relative

• display: inline-block

• overflow: hidden | Applied directly to child <a> element. Binds overlay positioning contexts and traps the zooming graphic without causing page reflow.
MD+ 1 |
| Dynamic Inner Radius | Applied to child > a:

border-radius: clamp(calc(radius * 0.5), calc(radius - spacing), radius) | Programmatically calculates nested anchor border radius relative to outer container radius and frame padding for concentric corners.
MD |
| Inner Graphic Media | Applied to img, video:

• transform: scale(1.08) on hover/focus | Receives scale transforms exclusively. Inherits clipped radius boundaries while keeping outer perimeter dimensions and shadows static.
MD+ 1 |
  
  
****3.5 Collision Engine & Three-Tier Veto System (_40-vetos.scss)****  
When interactive components are nested within an active parent card, the collision engine enforces structural vetoes to prevent compound transforms ("double-lift") or overlapping shadow states:  
  
SCSS  
  
```
// Veto Boundary Loop Execution (_40-vetos.scss)
@each $parent in $cards {
    // TRACK A: CARD-IN-CARD BOUNDARIES
    // Silences nested cards (e.g., inner columns/groups) inside a parent card
    @each $child-card in $cards {
        #{$parent}:hover #{$child-card} {
            @include phys.apply-silence($interactive: true); // Strips transform & shadow
        }
    }

    // TRACK B: OBJECT-IN-CARD BOUNDARIES
    // Silences nested layout objects inside an active parent card
    @each $child-object in $objects {
        #{$parent}:hover #{$child-object} {
            @include phys.apply-silence($interactive: true); // Strips transform & shadow
        }
    }

    // TRACK C: IMAGE-IN-CARD BOUNDARIES (Selective Veto)
    // Silences ONLY shadows on embedded images, preserving zoom/scale kinetics!
    @each $child-image in $images {
        #{$parent}:hover #{$child-image} {
            @include phys.apply-silence-shadow($interactive: true); // Strips shadow ONLY
        }
    }
}

```
* **Selective Image Veto Nuance:** Embedded image portals retain their internal zoom kinetic capabilities (scale(1.08)) while their outer box shadows are suppressed (apply-silence-shadow) to prevent double-shadow artifacts inside parent cards.MD  
## 3.6 Layout Brakes, Column Stacking & Global Overrides  
**Layout Brakes & Rounding Stops (_00-config.scss)**  
* **Hard Stop ($blocks-no-rounding):** Hard-coded exclusion list (.wp-block-column, .wp-block-media-text__media, .wp-block-media-text__content) where the engine does not generate border-radius CSS.  
* **Conditional Stop ($blocks-layout-brakes):** Specific style utility classes (.is-style-object-static, .is-style-image-no-border, .is-style-no-gap *) that suppress active transforms and default shadows.  
**Motion Kill-Switch (500-static.json / Lumina Static)**  
* **Zero-Kinetic Style Variation:** A dedicated global style variation designed for complete motion accessibility and pure typographic focus.  
* **Transform Neutralization:** Sets hoverTransform: "none" site-wide, suppressing physical scale growth and vertical displacement while falling back smoothly to clean, static opacity shifts (0.7 link hover / 0.85 image hover).  
**Intent-Based Column Height & Stacking Engine (columns_lumina.scss)**  
* **Full Height Stretching:** Columns containing vertical flex groups automatically stretch inner card stacks to 100% height across both is-content-justification-* and is-vertically-aligned-* Gutenberg class families.  
* **Mobile Column Reordering:** .is-style-first-on-mobile applies order: -1 !important on mobile viewports (<782px), forcing tagged columns or media blocks above text content when stacked.  
**Accessibility Mechanics (prefers-reduced-motion)**  
When reduced motion is requested by the OS or user settings, CSS variables adapt dynamically:  
  
* Transition timing extends from 250ms/500ms up to 500ms/800ms.  
* Scale growth transforms damp down from 1.05x / 1.08x to 1.01x / 1.04x.  
* Vertical displacement dampens from -3px / -4px down to -1px / -2px.  
**Interactive Card Arrow Overlay Badge (.lumina-card-arrow-overlay)**  
Interactive cards (.is-interactive-card) support an absolute-positioned floating arrow overlay badge that neutralizes Gutenberg block-gap margins and expands smoothly on hover:  
  
SCSS  
  
```
.is-interactive-card {
    position: relative !important;
}

.lumina-card-arrow-overlay {
    position: absolute;
    margin: 0 !important; // Neutralizes WP layout block-gap
    top: var(--wp--preset--spacing--40, 1.5rem);
    right: var(--wp--preset--spacing--40, 1.5rem);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--wp--preset--color--foreground, #000000);
    color: var(--wp--preset--color--background, #ffffff);
    opacity: 0;
    transform: scale(0.65);
    transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1), 
                transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.is-interactive-card:hover > .lumina-card-arrow-overlay {
    opacity: 1;
    transform: scale(1);
}

```
##   
## 3.7 Visual Debug Engine Configuration  
When developer debugging is enabled ($lumina-debug: true), the engine draws color-coded outlines and offset indicators across the layout viewport:  
  
SCSS  
  
```
// Configuration Debug Parameters (_00-config.scss)
$lumina-debug: true;

$debug-registry:       1px dashed #ff8c00; // Orange: Registry active
$debug-wrapper:        1px dashed #ff8c00; // Orange: Clipped wrapper
$debug-wrapper-active: 1px solid  #ff00ff; // Purple: Wrapper hover active
$debug-card:           1px solid  #00ffff; // Cyan: Tier 20 Container Card
$debug-object:         1px solid  #00ffff; // Cyan: Tier 10 Layout Asset
$debug-button:         1px solid  #00ffff; // Cyan: Tier 30 Sovereign Button
$debug-silence:        1px dashed #ff3b30; // Red: Veto active (resting)
$debug-silence-active: 1px solid  #ff3b30; // Red: Veto active (hover)

```
  
# Section 4: WordPress Core Governing Map & Utility Tooling  
##   
## 4.1 Overview & WordPress Standards Alignment  
To ensure long-term maintainability, high performance, and seamless compatibility with WordPress Core, Lumina adheres strictly to official **WordPress Coding Standards (WPCS)** across all languages and file types. Every contribution—whether in PHP, JavaScript, SCSS/CSS, or JSON—must comply with strict sniffer rules, accessibility standards, and native WordPress architectures.  
  
## 4.2 SCSS & CSS Architecture Rules  
SCSS development follows six non-negotiable architectural rules derived from the Lumina Physics Engine and Theme Bridge (src/scss/):  
  
**Rule 1: Sass Module System Enforcement (@use / @forward)**  
Traditional @import statements are strictly banned to avoid global namespace pollution, duplicate CSS output, and circular dependency loops.  
  
* **Namespace Isolation:** All configuration settings and helper mixins must be imported explicitly via @use with local namespaces or aliases (e.g., @use '00-config' as config;).  
* **Barrel Forwarding Pattern:** Subdirectory entry points (such as physics/_index.scss) act as single sources of truth, using @forward to expose module mixins and variables without circular import loops.  
**Rule 2: Specificity Governance via Declarative Compilation**  
No SCSS module may contain raw specificity overrides or !important flags to force style priority.  
* **Central Compiler Utility:** All dynamic selectors must pass through compile-selector() in _01-compiler.scss.  
* **Tier Bounds:** CSS selectors must strictly conform to their assigned Authority Tier (Tier 10 Objects 0,1,0, Tier 20 Cards 0,2,0, Tier 30 Sovereigns 0,3,0).  
* **Pseudo Wrappers:** Structural filters must be wrapped inside :is() and :not() pseudo-classes to keep compiled specificity scores flattened and mathematically predictable.  
**Rule 3: Defensive Schema Merging (map.merge)**  
Block registry definitions inside SCSS maps must never require redundant key declarations.  
  
* Every loop iterating over $lumina-block-registry must merge target maps with $registry-defaults (_00-config.scss) before extracting properties. This guarantees that unassigned parameters safely inherit default values (such as trigger: 'self' or role: 'object') without throwing Sass compilation errors.  
**Rule 4: Theme Interoperability Bridge (_theme-bridge.scss)**  
To ensure imported patterns from external themes (TwentyTwentyFour, TwentyTwentyFive, Flat Blocks) render seamlessly without custom PHP re-authoring:  
* **Automated Utility Translation:** An @each loop maps external class utilities (.has-tertiary-color, .has-accent-background-color) directly to Lumina tokens.  
* **Zero-Specificity Cascade:** Fallback rules utilize :where() wrappers to guarantee zero-specificity selector precedence, allowing parent styles to override defaults without cascade battles.  
  
**Rule 5: Gutenberg UI Safety & Variable Separation**  
Theme styles must never break the WordPress Block Editor interface or create visual feedback loops.  
  
* **Banned Palette Patterns:** Dynamic or context-dependent tokens such as currentColor must **never** be registered as selectable circular color dots in theme.json.  
* **CSS Custom Property Abstraction:** Palette-agnostic dynamic tokens must be scoped strictly via developer-controlled CSS custom properties (--wp--custom--color--muted-text) or injected via class styles.  
**Rule 6: Single-Class Refactor Pattern for Visual Effects**  
Complex visual effects (e.g., aspect-ratio toggles, liquid glass, ambient depth badges) must be authored as single-class refactor blocks using pseudo-elements (::before and ::after):  
  
* **Parent Element (.is-style-*):** Sets relative positioning, layout mode, base border-radius: inherit, and z-index positioning.  
* **::before (Mask & Label Layer):** Manages backdrop blurs, background fills, opacity tints, or tooltip label content.  
* **::after (Refraction & Icon Layer):** Manages inset highlights, SVG icon masks, and kinetic rotation transforms.  
## 4.3 JavaScript Engine Standards (lumina-physics.js)  
JavaScript in Lumina turns static Gutenberg blocks into intuitive, interactive surface areas while maintaining strict event isolation and client-side stability. All theme scripts must conform to the following jQuery / Vanilla JS coding standards:  
  
**Rule 1: Standard No-Conflict jQuery IIFE Wrapper**  
All JavaScript files must wrap execution inside the standard WordPress no-conflict Immediately Invoked Function Expression (IIFE). Unscoped global variables or direct $() execution outside of this closure are prohibited:  
  
JavaScript  
  
```
( function( $ ) {
    $( document ).ready( function() {
        // Theme initialization logic
    } );
} )( jQuery );

```
  
**Rule 2: Dynamic Target Validation (getValidTarget)**  
Before altering DOM classes, applying dynamic cursor styles (cursor: pointer), or attaching event interceptors to container blocks, scripts must run target elements through validation logic:  
  
* **Form Protection:** Containers carrying interactive HTML forms or text inputs (form, input:not([type="hidden"]), textarea, select) must **never** be converted into card click targets.  
* **Single Interactive Target Guarantee:** Cards are validated only if they contain **exactly one** primary link or button ($buttons.length === 1 && $links.length === 0 or vice versa). Multi-link containers are ignored to prevent ambiguous navigation behavior.  
**Rule 3: Event Delegation & Safety Valves**  
To ensure compatibility with dynamic AJAX content loading, scripts must use delegated document listeners ($(document).on('click', selector, handler)):  
  
* **Safety Valve Interception:** When a user clicks directly on an inner button, anchor link, or form control nested inside an interactive card, the handler must immediately exit (return) and allow native browser navigation to process naturally without infinite click loops:  
JavaScript  
  
```
if ($(e.target).closest('button, a, .wp-element-button, input, select').length) {
    $card.removeClass('is-active');
    return; // Pass control to native element
}

```
**Rule 4: Touch-First Two-Tap Gesture Handling**  
To eliminate mobile touch bugs (where hover states flicker or accidental link jumps occur during page scrolling), all card interactions must implement two-tap touch handling:  
  
* **Tap 1 (Activation):** Adds the .is-active state class, revealing visual badges (such as .lumina-card-arrow-overlay) and suppressing immediate link navigation.  
* **Tap 2 (Execution):** Executes the actual navigation action.  
* **Scroll/Swipe Cancellation:** Listening to touchmove events immediately cancels pending tap activation flags so swiping or scrolling through content never triggers unintended card clicks.  
**Rule 5: Scoped Client-Side Preference Persistence (localStorage)**  
Interactive UI components that retain user display states (such as <details> accordions or aspect ratio toggles) must utilize localStorage with multi-tier key scoping:  
  
* **Page-Path & Element Scoping:** Keys must combine the sanitized window pathname, element identifier, and DOM index ('lumina_aspect_state_' + pagePath + '_' + elementIdentifier + '_' + index) so user preferences do not bleed across different pages.  
## 4.4 PHP & Full-Site Editing (FSE) Standards  
PHP code in Lumina forms the foundation for block style registration, template hierarchy routing, pattern conversion, and WP 7.1 Icon API integration.  
**Rule 1: Strict WPCS Syntax & Namespace Rules**  
* **Code Style:** All PHP files must pass WordPress Coding Standards via PHP_CodeSniffer (WordPress-Core, WordPress-Docs, WordPress-Extra).  
* **Strict Typing & Direct Access Protection:** All standalone PHP files must include direct-access prevention guards and declare strict types:  
PHP  
  
```
<?php
/**
 * Lumina Theme Functions
 *
 * @package Lumina
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

```
* **Global Namespace Prefixing:** All functions, classes, constants, and global hooks must carry the strict lumina_ or LUMINA_ prefix (or namespace NicheWP\Lumina).  
**Rule 2: FSE-Native Philosophy & Block Style Performance**  
* **No Custom Metaboxes:** Layout settings, color configurations, and spatial adjustments must rely exclusively on native Block Editor controls and theme.json capabilities.  
* **Inline Block Style Enqueuing (lumina_load_block_styles):** Custom block styles residing in /assets/css/blocks/*.css are registered via wp_enqueue_block_style() passing the direct file path. This allows WordPress to inline CSS directly into the document <head> when the block is rendered rather than firing external HTTP stylesheet requests.  
**Rule 3: WordPress 7.1 Icon API Integration (icons.php)**  
Custom theme icons are auto-registered using native WP 7.1 Icon API hooks:  
* **Dynamic Directory Scanning:** Scans assets/icons/theme/*.svg dynamically, building human-readable labels from filenames (arrow-curved-up -> Arrow Curved Up).  
* **Collection Namespacing:** Registers a dedicated THEME_SLUG icon collection (wp_register_icon_collection) and registers individual icons (wp_register_icon) using lazy-loaded file_path parameters.  
**Rule 4: Automated Pattern Converter Utility (patterns2php.sh)**  
HTML pattern block layouts in /patterns/html/ are compiled into production PHP pattern files in /patterns/converted/ using a Zsh build script:  
* **Filename Order Preservation:** Output .php files retain leading numeric ordering prefixes on disk (01-hero-banner.php) for clean local file organization.  
* **Clean Pattern Slugs & Metadata:** Numeric prefixes are automatically stripped during docblock manifest generation, creating clean pattern slugs (lumina/hero-banner), human-readable titles (Hero Banner), category taxonomies, and core block type associations.  
* **Automated i18n & Asset Binding:** Wraps inner tag text inside WordPress translation functions (esc_html_e("...", "lumina")), strips hardcoded block IDs ("id":123), and rewrites local image sources to dynamic get_theme_file_uri() calls.  
##   
## 4.5 Code Quality Compliance Matrix  
Before any pull request or theme update is merged into the Lumina codebase, it must pass the following multi-layer validation matrix:  
MD  
  

| Layer / Component | Tooling / Engine | Key Verification Requirement | Success Criteria |
| -------------------------------- | ------------------------------- | ------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------- |
| PHP Engine | PHP_CodeSniffer(WPCS) | Strict typing, prefixing (lumina_), zero unescaped output, WPCS compliance.
MD | 0 Errors / 0 Warnings
MD |
| SCSS / CSS Engine | Stylelint / Sass Compiler | Sass Module compliance (@use), specificity score alignment (Tiers 10–30), zero !important rules.
MD | Clean compilation without deprecated imports.
MD |
| JavaScript Engine | WP jQuery Standards | WP IIFE wrapper, getValidTarget form protection, mobile two-tap touch isolation, scoped localStorage keys.
MD | Smooth card navigation, zero infinite recursion loops.
MD |
| theme.jsonSchema | WP Schema Validator | WCAG AA color pair validation, Settings/Styles separation, zero currentColor selectable palette dots.
MD | Valid WP 6.x / 7.x theme.jsonschema confirmation.
MD |
| Icon API (icons.php) | WP 7.1 Icon Registry | Dynamic SVG directory scanning, valid property attributes. | Clean registration in Block Editor Icon Picker. |
| Pattern Engine (patterns2php.sh) | Zsh / Perl Engine | Preserves numeric disk prefixes (01-*.php), generates clean slugs (lumina/*), wraps text in esc_html_e(), rewrites image URIs. | Successful conversion count with zero syntax or translation errors. |
| Kinetics Engine | Visual Debugger ($lumina-debug) | Correct role outline assignment, proper parent-child veto execution (apply-silence).
MD | Zero double-lift or double-shadow artifacts in visual inspector.
MD |
  
