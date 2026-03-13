<?php $page_title = 'تسجيل الدخول';
include __DIR__ . '/../includes/header.php'; ?>

<main class="container section-padding" style="max-width:720px;">
  <div class="feature-card" data-aos="fade-up">
    <h2 class="mb-4">تسجيل الدخول</h2>
    <?php if (!empty($_GET['err'])): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['err']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_GET['ok'])): ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($_GET['ok']); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo APP_BASE; ?>/backend/auth/process_login.php" class="row g-3">
      <form method="post" action="<?php echo APP_BASE; ?>/backend/auth/process_login.php" class="row g-3">
        <div class="col-12">
          <label class="form-label">رقم الهاتف</label>
          <input type="tel" name="phone" class="form-control" placeholder="05XXXXXXXX" required>
        </div>
        <div class="col-12">
          <label class="form-label">رقم الوحدة السكنية</label>
          <input type="text" name="unit_code" class="form-control" placeholder="مثال: B01-A3 أو V012" required>
        </div>
        <div class="col-12">
          <label class="form-label">الرقم السري</label>
          <div class="pw-wrapper">
            <input type="password" name="password" class="form-control" id="login-password" required>
            <span class="pw-toggle" data-target="#login-password">👁️</span>
          </div>
        </div>
        <div class="col-12 d-grid d-md-flex gap-2 auth-actions">
          <button class="btn btn-gradient" type="submit">دخول</button>
          <a class="btn btn-outline-light" href="<?php echo APP_BASE; ?>/backend/auth/register.php">إنشاء حساب</a>
        </div>
      </form>
  </div>
  <p class="text-center text-muted mt-3">يمكن للمسؤولين الدخول باستخدام بريدهم أيضاً.</p>
  <div class="text-center mt-2"><a class="link-light" href="<?php echo APP_BASE; ?>/index.html">العودة للصفحة الرئيسية</a></div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

