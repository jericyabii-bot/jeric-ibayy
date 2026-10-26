<?php
// ----- Edit your details here -----
$name  = "Jeric Ibay";
$role  = "Graphic Designer";
$email = "Jericyabii@gmail.com";
$pageTitle = $name . " - " . $role;

// List of works (change the titles, categories, and descriptions)
$works = [
    [
        "title" => "Vanta Logo", "category" => "Logos", "class" => "w1",
        "desc" => "Logo concept for a creative studio. Bold monogram with a clean wordmark.",
        "art" => '<div class="logo-art"><div class="mark">V</div><div class="word">VANTA</div><div class="tag">CREATIVE STUDIO</div></div>'
    ],
    [
        "title" => "Midnight Sessions", "category" => "Posters", "class" => "w2",
        "desc" => "Event poster concept with a strong red focal point and big type.",
        "art" => '<div class="sheet poster"><div class="p-circle"></div><div class="p-title">MIDNIGHT<br>SESSIONS</div><div class="p-info">LIVE MUSIC<br>OCT 24 &middot; 8 PM</div></div>'
    ],
    [
        "title" => "Halden Coffee", "category" => "Branding", "class" => "w3",
        "desc" => "Brand identity board with logo, color palette, and typography.",
        "art" => '<div class="board"><div class="b-logo"><i></i>HALDEN</div><div class="b-sw"><span style="background:#e5262b"></span><span style="background:#0a0a0a"></span><span style="background:#8a8a8a"></span><span style="background:#d8cfc0"></span></div><div class="b-type">Aa <small>Colors and type</small></div></div>'
    ],
    [
        "title" => "Northline Drop", "category" => "Social", "class" => "w4",
        "desc" => "Social media post concept for a streetwear collection launch.",
        "art" => '<div class="post"><div class="s-top">@northline.co</div><div class="s-main">NEW<br>DROP</div><div class="s-sub">Streetwear Collection<br>Out now</div></div>'
    ],
    [
        "title" => "Design Workshop", "category" => "Posters", "class" => "w5",
        "desc" => "Event flyer concept with a diagonal color block and clear details.",
        "art" => '<div class="sheet flyer"><div class="f-band"></div><div class="f-title">DESIGN<br>WORKSHOP</div><div class="f-info">FREE ENTRY<br>NOV 12 &middot; 2 PM</div></div>'
    ],
    [
        "title" => "Type Specimen", "category" => "Branding", "class" => "w6",
        "desc" => "Typography exercise showing hierarchy and letter spacing.",
        "art" => '<div class="type"><div class="t-big">Aa</div><div class="t-row">ABCDEFGHIJKLM<br>abcdefghijklm<br>0123456789</div></div>'
    ],
];
// To use your own image instead, add:  "image" => "images/yourfile.jpg"  to a work.

// Filter buttons are made from the categories above
$categories = array_unique(array_column($works, "category"));

// ----- Contact form -----
$message = "";
$error = "";
$senderName = "";
$senderEmail = "";
$senderMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderName  = trim($_POST["sender_name"]);
    $senderEmail = trim($_POST["sender_email"]);
    $senderMsg   = trim($_POST["sender_msg"]);

    if ($senderName == "" || $senderEmail == "" || $senderMsg == "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        // To really send the email, remove the // below (needs a mail server, not available in XAMPP by default)
        // mail($email, "Message from " . $senderName, $senderMsg, "From: " . $senderEmail);
        $message = "Thank you, " . htmlspecialchars($senderName) . "! Your message was sent.";
        $senderName = $senderEmail = $senderMsg = "";
    }
}

include "header.php";
?>

<main>
  <section class="hero" id="home">
    <p class="hi">Hello, I'm</p>
    <h1><?php echo strtoupper(explode(" ", $name)[0]); ?> <span><?php echo strtoupper(explode(" ", $name)[1]); ?></span></h1>
    <h2><?php echo $role; ?></h2>
    <a class="btn" href="#contact">Contact Me</a>
  </section>

  <section class="about" id="about">
    <div class="container reveal">
      <h3 class="title">About Me</h3>
      <p>I'm <?php echo $name; ?>, a graphic designer. I like making logos, posters, and social media designs that look clean and get noticed.</p>
      <p>I enjoy turning ideas into simple and creative designs.</p>
    </div>
  </section>

  <section id="works">
    <div class="container reveal">
      <h3 class="title">My Works</h3>

      <div class="filters">
        <button class="filter active" data-filter="all">All</button>
        <?php foreach ($categories as $cat) { ?>
          <button class="filter" data-filter="<?php echo $cat; ?>"><?php echo $cat; ?></button>
        <?php } ?>
      </div>

      <div class="works">
        <?php foreach ($works as $work) { ?>
          <div class="work" data-category="<?php echo $work["category"]; ?>">
            <div class="img <?php echo $work["class"]; ?>">
              <?php if (isset($work["image"])) { ?>
                <img src="<?php echo $work["image"]; ?>" alt="<?php echo $work["title"]; ?>">
              <?php } else { echo $work["art"]; } ?>
            </div>
            <h4><?php echo $work["title"]; ?></h4>
            <p class="cat"><?php echo $work["category"]; ?> &middot; Concept project</p>
            <p class="desc"><?php echo $work["desc"]; ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="contact" id="contact">
    <div class="container reveal">
      <h3 class="title">Contact Me</h3>
      <p>Want to work with me? Send me an email or use the form below.</p>
      <a class="mail" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>

      <form method="post" action="#contact" class="form">
        <?php if ($message != "") { ?><p class="success"><?php echo $message; ?></p><?php } ?>
        <?php if ($error != "") { ?><p class="error"><?php echo $error; ?></p><?php } ?>

        <input type="text" name="sender_name" placeholder="Your name" value="<?php echo htmlspecialchars($senderName); ?>">
        <input type="email" name="sender_email" placeholder="Your email" value="<?php echo htmlspecialchars($senderEmail); ?>">
        <textarea name="sender_msg" rows="4" placeholder="Your message"><?php echo htmlspecialchars($senderMsg); ?></textarea>
        <button type="submit" class="btn">Send Message</button>
      </form>
    </div>
  </section>
</main>

<?php include "footer.php"; ?>
