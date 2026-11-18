<?php $events = db()->query("SELECT * FROM events ORDER BY event_year ASC, id ASC")->fetchAll(); ?>
<section class="page-hero"><span class="eyebrow">NHỮNG CỘT MỐC</span><h1 class="page-title">Dấu ấn lịch sử</h1><p>Dòng thời gian tương tác ghi lại những dấu mốc quan trọng trong cuộc đời Bác Tôn.</p></section>
<div class="timeline">
<?php foreach ($events as $event): ?>
    <button class="timeline-item" type="button" data-timeline-title="<?= e($event['title']) ?>" data-timeline-year="<?= e($event['event_year']) ?>" data-timeline-desc="<?= e($event['description']) ?>">
        <span class="timeline-year"><?= e($event['event_year']) ?></span><span class="timeline-dot"></span><span class="timeline-card"><b><?= e($event['title']) ?></b><small><?= e($event['description']) ?></small><em>Nhấn để xem chi tiết</em></span>
    </button>
<?php endforeach; ?>
<?php if (!$events): ?><p>Chưa có mốc thời gian. Vui lòng bổ sung tại trang quản trị.</p><?php endif; ?>
</div>
<div class="timeline-detail" id="timelineDetail" hidden><button class="modal-close" type="button">×</button><span id="detailYear"></span><h2 id="detailTitle"></h2><p id="detailDescription"></p></div>
