# Lumina Theme Project Charter v1.0.0 Alpha 
# Section 1: Project Vision & Features

## 1.1 Project Vision: Modern Full-Site Editing

Lumina represents a modern evolution of WordPress Full-Site Editing (FSE). Inspired by the colors, ambient light, and natural depth of the physical environment around us, Lumina bridges organic aesthetics with high-performance digital web architecture. 

We believe website layouts should feel balanced, tactile, and natural—bringing the structural rhythms and light behavior of the physical world directly onto the digital canvas. 

The Lumina theme demo is a showcase for a high-end photography or web design studio. It shows how the default theme color palette is intended to be used with mostly neutral or subtle colors with bold page heroes and call-to-action sections. It demonstrates restrained use of glass over cover images. It features interactive cards and pan-zoom motion images which are flagship features of the theme.  

See the [technical documentation overview](https://nichewp.github.io/lumina/) for implementation details.

## 1.2 Dynamic Moods via Global Styles

While Lumina provides numerous color palettes and curated fonts, it's Global Style variations let site creators choose a cohesive visual mood and adapt it in the Site Editor. Each **Lumina Mood** expresses a distinct approach to form, spacing, and interaction:

* **Lumina Gallery:** Designed for high-end exhibition spaces and editorial layouts. Features slightly rounded architectural corners, generous spacing, and luxurious, deliberate motion that gives interactive elements a weighted, physical presence.
* **Lumina Tactical:** Tailored for utility, speed, and dense information architecture. Uses compact spacing and crisp, quick-response motion for a focused, efficient feel.
* **Lumina Spacious:** An ultra-modern, fluid mood. Pairs soft, pebble-like forms and expansive spacing with playful, elastic motion.
* **Lumina Minimal:** A refined, reduced-motion mood for a quieter, typographic focus. Interactive elements avoid pronounced scaling or shifting while retaining subtle feedback.

See the [theme variables and style reference](https://nichewp.github.io/lumina/variables.html) for current implementation details.

## 1.3 Color Schemes & the Lumina Colors Engine

Lumina's color schemes offer distinct expressions of the theme's visual identity while sharing semantic color roles:

* **Elements (standard):** Sage green, ocean blue, and golden sun create a nature-inspired balance of flora, water, and warmth.
* **Horizon (standard):** Coastal terracotta, ocean blue, and golden sun bring an earthy, open feeling shaped by land and sea.
* **Heritage (standard):** Patina crimson, burnished brass, and midnight blue evoke the thoughtful richness of a professor's library.
* **Ember (standard):** Fiery terracotta, gold, and volcanic umber give the palette a warm, glowing energy.
* **Velvet (standard):** Plum, sapphire, and crimson jewel tones create a rich and expressive atmosphere.
* **Dusk (standard):** Evening slates and twilight terracotta capture the subdued, contemplative mood of the blue hour.
* **Low Tide (dark):** Deep water, gray stone, and glistening sand suggest a dramatic shoreline after the tide recedes.
* **Zinc (dark):** Machined metal and gunmetal tones give the palette a restrained, industrial character.
* **Light (high-key):** Soft linen amber, ocean slate, and sage linen create an airy, luminous treatment.
* **Lumina Full Palette:** A broad starting palette that exposes the theme's wider range of named colors and semantic roles.

The Lumina Colors Engine and its semantic color registry connect each color role to theme-authored treatments for body text, headings, and links. This gives the theme author control over intended contrast relationships and supports accessible, coherent defaults. Creators should still check contrast when they customize colors and content; the engine does not guarantee WCAG compliance for every possible combination.

See the [theme variables and color documentation](https://nichewp.github.io/lumina/variables.html).

## 1.4 Typography & Curated Fonts

Lumina's default pairing uses Lato for body text and Raleway for headings. Lato provides a clear, approachable reading voice, while Raleway gives headings a more distinctive, architectural character and establishes visual hierarchy. 

The theme also includes Lora for a more traditional serif voice, Open Sans as an alternate sans-serif, Style Script for decorative accents, and Roboto Mono for technical or code-like text. These additional families give creators more ways to shape a site's personality; they are options rather than required roles. 

See the [theme variables and typography documentation](https://nichewp.github.io/lumina/variables.html).

## 1.5 Ambient Light & Organic Depth

Lumina's visual language follows a consistent direction of light from the upper left. Color-mixed borders, translucent glass surfaces, and gradients suggest softly lit edges and reflections. The Lumina Physics Engine carries this sense of light into depth: objects rest on subtle, natural shadows, then interactive elements designed to move lift from the surface and cast deeper shadows. Together, the highlights, shadows, and motion make surfaces feel tactile and connected to the same organic environment. 

See the [SCSS technical documentation](https://nichewp.github.io/lumina/scss/index.html).

## 1.6 Templates, Template Parts & Block Patterns

Lumina includes a broad collection of templates, template parts, and block patterns so creators can shape the whole site, not just its colors and typography. Templates provide page-level starting points; template parts make shared areas such as headers and footers reusable; and patterns offer ready-to-insert sections and page compositions. Creators can adapt these building blocks in the Site Editor to suit their content and brand.

 Explore the documentation for [templates](https://nichewp.github.io/lumina/templates.html), [template parts](https://nichewp.github.io/lumina/parts.html), and [block patterns](https://nichewp.github.io/lumina/patterns.html).
  
# Section 2: Lumina Color Engine & Palette Guide

## 2.1 Guidelines for Standard Schemes

In the standard schemes, primary, secondary, and tertiary colors provide the stronger brand accents used in hero sections, calls to action, and feature areas. Their alternate colors offer a deeper or more emphatic companion. Subtle colors create quieter surfaces for grouped content, feature icons, galleries, and pricing cards. Neutral colors support the page canvas, supporting sections, dividers, and other structural details.

The following lightness ranges describe the current palettes as a guide, not fixed requirements. Individual schemes vary to preserve their character, and the role of a color matters more than matching a number:

* **Primary, secondary, and tertiary:** Usually around 30-50% lightness, with many values in the 40s; `*-alt` companions are often around 18-38%. Heritage and Dusk use some notably deeper main accents.
* **Subtle surfaces:** Commonly around 91-92%; the less common `*-subtle-alt` colors are closer to 83-84%.
* **Deep accents:** `primary-dark`, `dark`, and `tertiary-dark` roles are generally around 18-28%, with their `*-alt` companions often around 12-20%.
* **Highlights:** `highlight` and `highlight-accent` colors are usually around 68-78%; their alternate colors are generally deeper, around 28-38%.
* **Neutrals:** `base` and `off-white` are typically around 96-99%, with `neutral` surfaces around 88-95%. The gray roles span from light structural tones through mid-grays to dark text and surface anchors.
* **Extended named hues:** In the Full Palette, saturated color anchors are commonly around the 40s, lighter companions around the 80s to low 90s, and darker companions from the 20s to upper 30s. Blue and midnight-blue anchors are some of the darker exceptions.

Choose colors for their role in the composition, then check that text and links remain clear against the selected surface.

## 2.2 Dark and Light Scheme Guidelines

The dark schemes shift the canvas and supporting surfaces into deeper tones, while light foreground colors and distinct accents maintain hierarchy. Their base and subtle surfaces are generally around 10-27% lightness, while contrast text and off-white roles remain near the high end of the range. Highlights stay luminous, and deeper accents provide separation between dark sections. Use changes in surface depth to distinguish content, and keep text and links legible against each chosen background.

The Light scheme takes the opposite approach: its primary, secondary, and tertiary colors become soft, high-key fills, generally around 85-91%, with alternate colors around 80-87% and subtle surfaces around 93-95%. Deeper colors, generally around 34-48%, remain available for prominent actions and contrast. These differences preserve the airy character of the scheme without losing visual anchors.

Treat these ranges as observations and design guidance rather than thresholds. Hue, neighboring colors, and the intended text treatment all affect the result; verify contrast in context.

## 2.3 Color Roles in Lumina Patterns

Lumina's patterns demonstrate how the semantic palette can establish hierarchy across real layouts. The examples below describe common uses, not rules that every pattern must follow.

| Color role | Related color slugs | How it appears in patterns | Design guidance |
| --- | --- | --- | --- |
| Primary (`primary`) | `primary-alt`, `primary-subtle`, `primary-subtle-alt`, `primary-dark`, `primary-dark-alt` | Brand-forward hero areas, featured sections, and calls to action. | Use to establish a clear focal point or support a primary action; use the related shades to vary emphasis and surface weight. |
| Secondary (`secondary`) | `secondary-alt`, `secondary-subtle`, `secondary-subtle-alt` | Alternate call-to-action sections, media-and-text panels, and supporting content bands. | Use to distinguish a related section or secondary action from the primary focal point. |
| Tertiary (`tertiary`) | `tertiary-alt`, `tertiary-subtle`, `tertiary-subtle-alt`, `tertiary-dark`, `tertiary-dark-alt` | Accent details, social and feature columns, and separator rules in pricing layouts. | Use selectively to add contrast and rhythm without making every section compete for attention. |
| Dark anchors | `dark`, `dark-alt`, `primary-dark`, `primary-dark-alt`, `tertiary-dark`, `tertiary-dark-alt` | Dark call-to-action panels and other intentionally dramatic sections. | Pair deeper surfaces with suitable light foreground colors and verify contrast in context. |
| Highlights and link accents | `highlight`, `highlight-alt`, `highlight-accent`, `highlight-accent-alt`, `highlight-accent-2`, `highlight-accent-2-alt` | Link treatments and emphasized statistics or values. | Reserve brighter accents for useful emphasis, and retain clear text contrast. |
| Neutral foundation | `base`, `contrast`, `neutral`, `neutral-alt`, `off-white`, `white`, `black`, `very-light-gray`, `light-gray`, `gray`, `dark-gray`, `very-dark-gray`, `almost-black`, `not-quite-black` | Page backgrounds, body and heading text, supporting surfaces, and dividers. | Use these roles as the visual foundation that keeps content readable and color accents organized. |
| Green family | `very-light-green`, `light-green`, `green`, `dark-green`, `bright-green`, `dark-bright-green` | Available for creator-selected accents and custom pattern compositions; the curated patterns primarily express color through the semantic roles above. | Choose a green by its role and contrast, rather than assuming a named hue is suitable for every text or surface use. |
| Yellow family | `very-light-yellow`, `light-yellow`, `yellow`, `dark-yellow` | Available for creator-selected accents and custom pattern compositions. | Use lighter variants for restrained fills and stronger variants for intentional accents; check foreground contrast. |
| Orange family | `very-light-orange`, `light-orange`, `orange`, `dark-orange` | Available for creator-selected accents and custom pattern compositions. | Use as a warm accent or supporting fill without letting it compete with primary actions. |
| Blue family | `very-light-blue`, `light-blue`, `blue`, `dark-blue`, `midnight-blue`, `dark-midnight-blue` | Available for creator-selected accents and custom pattern compositions. | Use the lighter tones for soft surfaces and deeper tones for stronger anchors; check text and link contrast. |
| Purple family | `very-light-purple`, `light-purple`, `purple`, `dark-purple` | Available for creator-selected accents and custom pattern compositions. | Use to add a distinct supporting accent while keeping the overall hierarchy clear. |
| Red family | `very-light-red`, `light-red`, `red`, `dark-red` | Available for creator-selected accents and custom pattern compositions. | Use deliberately for emphasis and keep essential meaning available through text or other cues as well. |

## 2.4 Using Color with Intent

Start with the purpose of a section—such as a primary action, a supporting feature, or a quiet content well—and choose a semantic color role to match. Lumina's curated editor palette and patterns provide consistent starting points, while creators remain free to adapt them. When using custom colors or importing patterns from another theme, review text and link contrast in context; color alone should not carry essential meaning.

For exact color values, palette definitions, and custom variables, see the [technical color documentation](https://nichewp.github.io/lumina/variables.html).

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
  
