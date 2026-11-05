#!/bin/zsh

# Scope paths
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
THEME_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"
DOCS_DIR="${THEME_ROOT}/docs"
MD_FILE="${DOCS_DIR}/patterns.md"
HTML_FILE="${DOCS_DIR}/patterns.html"

mkdir -p "$DOCS_DIR"

# Collect all pattern files
pattern_files=("${THEME_ROOT}"/patterns/**/*.php(N))

if (( ${#pattern_files} == 0 )); then
    echo "⚠️  No pattern files found in ${THEME_ROOT}/patterns"
    exit 0
fi

# -----------------------------------------------------------------------------
# SINGLE-PASS PARSING ENGINE (Perl)
# -----------------------------------------------------------------------------
perl -e '
use strict;
use warnings;

my $md_file   = shift @ARGV;
my $html_file = shift @ARGV;
my @rows      = ();

for my $file (sort @ARGV) {
    open my $fh, "<", $file or next;
    local $/ = undef;
    my $content = <$fh>;
    close $fh;

    my ($title) = $content =~ /^[ \t]*\*[ \t]*Title:[ \t]*(.+?)\r?$/mi;
    my ($slug)  = $content =~ /^[ \t]*\*[ \t]*Slug:[ \t]*(.+?)\r?$/mi;
    my ($cats)  = $content =~ /^[ \t]*\*[ \t]*Categories:[ \t]*(.+?)\r?$/mi;
    my ($desc)  = $content =~ /^[ \t]*\*[ \t]*Description:[ \t]*(.+?)\r?$/mi;

    $title = "" unless defined $title;
    $slug  = "" unless defined $slug;
    $cats  = "" unless defined $cats;
    $desc  = "" unless defined $desc;

    # Strip whitespace
    s/^\s+|\s+$//g for ($title, $slug, $cats, $desc);

    if ($title ne "" && $slug ne "") {
        push @rows, { title => $title, slug => $slug, cats => $cats, desc => $desc };
    }
}

# Write Markdown
open my $mfh, ">", $md_file or die "Cannot write $md_file: $!";
print $mfh "# Lumina Theme Architecture: Block Patterns Catalog\n\n";
print $mfh "| Title | Slug | Categories | Description |\n";
print $mfh "| :--- | :--- | :--- | :--- |\n";
for my $r (@rows) {
    print $mfh "| **$r->{title}** | `$r->{slug}` | `$r->{cats}` | $r->{desc} |\n";
}
close $mfh;

# Write HTML
open my $hfh, ">", $html_file or die "Cannot write $html_file: $!";
print $hfh <<"HTML_HEADER";
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lumina Block Patterns & Template Parts Catalog</title>
	<style>
		:root {
			--bg: #0f172a;
			--card: #1e293b;
			--border: #334155;
			--text: #f8fafc;
			--text-sub: #94a3b8;
			--accent: #38bdf8;
			--font: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
		}
		body { background: var(--bg); color: var(--text); font-family: var(--font); padding: 2rem; margin: 0; }
		.container { max-width: 1200px; margin: 0 auto; }
		header { margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }
		header h1 { margin: 0 0 0.5rem 0; font-size: 2rem; }
		header a { color: var(--accent); text-decoration: none; font-size: 0.9rem; }
		table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: 8px; overflow: hidden; }
		th, td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--border); }
		th { background: #0f172a; color: var(--accent); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }
		tr:last-child td { border-bottom: none; }
		code { background: #0f172a; color: var(--accent); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.875rem; }
		.desc { color: var(--text-sub); font-size: 0.9rem; }
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>Lumina Block Patterns Catalog</h1>
			<a href="index.html">&larr; Back to Documentation Portal</a>
		</header>
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Slug</th>
					<th>Categories</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
HTML_HEADER

for my $r (@rows) {
    print $hfh "\t\t\t\t<tr>\n";
    print $hfh "\t\t\t\t\t<td><strong>$r->{title}</strong></td>\n";
    print $hfh "\t\t\t\t\t<td><code>$r->{slug}</code></td>\n";
    print $hfh "\t\t\t\t\t<td><code>$r->{cats}</code></td>\n";
    print $hfh "\t\t\t\t\t<td class=\"desc\">$r->{desc}</td>\n";
    print $hfh "\t\t\t\t</tr>\n";
}

print $hfh <<"HTML_FOOTER";
			</tbody>
		</table>
	</div>
</body>
</html>
HTML_FOOTER
close $hfh;
' "$MD_FILE" "$HTML_FILE" "${pattern_files[@]}"

echo "🎉 Generated both ${MD_FILE#$THEME_ROOT/} and ${HTML_FILE#$THEME_ROOT/}"
