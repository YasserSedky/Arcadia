<?php $page_title = 'إنشاء حساب';
include __DIR__ . '/../includes/header.php'; ?>

<main class="container section-padding" style="max-width:920px;">
  <div class="feature-card" data-aos="fade-up">
    <h2 class="mb-4">إنشاء حساب جديد</h2>
    <?php if (!empty($_GET['err'])): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['err']); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo APP_BASE; ?>/backend/auth/process_register.php" class="row g-3">
      <div class="col-md-6">
        <label class="form-label">الاسم بالكامل</label>
        <input type="text" name="full_name" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">رقم الهاتف</label>
        <input type="tel" name="phone" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">هوية المستخدم</label>
        <select name="role_code" class="form-select" required>
          <option value="resident">مقيم</option>
          <option value="maintenance_worker">عامل صيانة</option>
          <option value="doctor">طبيب</option>
          <option value="nurse">ممرض</option>
          <option value="hospital_staff">عامل في المستشفى</option>
          <option value="admin_staff">إداري</option>
        </select>
      </div>
      <div class="col-md-6" id="unit_code_field">
        <label class="form-label">الوحدة السكنية <span class="text-danger">*</span></label>
        <select name="unit_code" class="form-select" id="unit_code_select" required>
          <option value="">اختر الوحدة السكنية</option>
          <?php
          require_once __DIR__ . '/../../database/config.php';
          $pdo = DB::conn();
          $units = $pdo->query("
            SELECT u.id, u.unit_code, u.unit_number, b.label as building_label, b.type as building_type
            FROM units u
            JOIN buildings b ON b.id = u.building_id
            WHERE b.type IN ('apartment_block', 'villa')
            ORDER BY b.type DESC, b.label, u.unit_number
          ")->fetchAll();
          foreach ($units as $unit):
          ?>
            <option value="<?= htmlspecialchars($unit['unit_code']) ?>">
              <?= htmlspecialchars($unit['unit_code']) ?> 
              (<?= $unit['building_type'] === 'apartment_block' ? 'عمارة ' : 'فيلا ' ?><?= htmlspecialchars($unit['building_label']) ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <script>
      document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.querySelector('select[name="role_code"]');
        const unitField = document.getElementById('unit_code_field');
        const unitSelect = document.getElementById('unit_code_select');
        
        function toggleUnitField() {
          if (roleSelect.value === 'resident') {
            unitField.style.display = 'block';
            unitSelect.required = true;
          } else {
            unitField.style.display = 'none';
            unitSelect.required = false;
            unitSelect.value = '';
          }
        }
        
        roleSelect.addEventListener('change', toggleUnitField);
        toggleUnitField(); // Initial check
      });
      </script>
      <div class="col-md-3 pw-wrapper">
        <label class="form-label">الرقم السري</label>
        <input type="password" name="password" class="form-control" id="reg-password" required>
        <span class="pw-toggle" data-target="#reg-password">👁️</span>
      </div>
      <div class="col-md-3 pw-wrapper">
        <label class="form-label">تاكيد الرقم السري</label>
        <input type="password" name="confirm_password" class="form-control" id="reg-confirm-password" required>
        <span class="pw-toggle" data-target="#reg-confirm-password">👁️</span>
      </div>
      <div class="col-12 d-grid d-md-flex gap-2 auth-actions">
        <button class="btn btn-gradient" type="submit">إنشاء الحساب</button>
        <a class="btn btn-outline-light" href="<?php echo APP_BASE; ?>/backend/auth/login.php">لك حساب؟ دخول</a>
      </div>
    </form>
  </div>
  <div class="text-center mt-2"><a class="link-light" href="<?php echo APP_BASE; ?>/index.html">العودة للصفحة الرئيسية</a></div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>



