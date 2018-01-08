<div class="row">
    <div class="col-md-12">
    	<div class="page-header">
     	    <h2>Agenda futura </h2>
    	</div>
    	<div class="table-responsive">
    		<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%;"><?= $this->Paginator->sort('activity_date', ['Fecha']) ?></th>
                        <th scope="col" style="width: 10%;"><?= $this->Paginator->sort('promoter', ['Responsable']) ?></th>
                        <th scope="col" style="width: 7%;"><?= $this->Paginator->sort('cell_promoter', ['Teléfono']) ?></th>
                        <th scope="col" style="width: 10%;"><?= $this->Paginator->sort('short_description_activity', ['Actividad']) ?></th>
                        <th scope="col" style="width: 10%;"><?= $this->Paginator->sort('full_name', ['Paciente']) ?></th>
                        <th scope="col" style="width: 10%;"><?= $this->Paginator->sort('surgery', ['Cirugía']) ?></th>
                        <th scope="col" style="width: 7%;"><?= $this->Paginator->sort('cell_phone', ['Teléfono']) ?></th>
                        <th scope="col" style="width: 10%;"><?= $this->Paginator->sort('email', ['Email']) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($diary as $diarys): ?>
                        <?php if ($current_user['role'] == 'Promotor(a)' || $current_user['role'] == 'Promotor(a) independiente'): ?>
                            <?php if ($current_user['id'] == $diarys->budget->patient->user->parent_user): ?>
                                <tr>
                                    <td><?= h($diarys->activity_date->format('d-m-Y')) ?></td>
                                    <td><?= $promoter[$diarys->id]['namePromoter'] ?></td>
                                    <td><?= $promoter[$diarys->id]['cellPromoter'] ?></td>
                                    <td><?= h($diarys->short_description_activity) ?></td>
                                    <td><?= h($diarys->budget->patient->user->full_name) ?></td>
                                    <td><?= h($diarys->budget->surgery) ?></td>
                                    <td><?= h($diarys->budget->patient->user->cell_phone) ?></td>
                                    <td><?= h($diarys->budget->patient->user->email) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr>
                                <td><?= h($diarys->activity_date->format('d-m-Y')) ?></td>
                                <td><?= $promoter[$diarys->id]['namePromoter'] ?></td>
                                <td><?= $promoter[$diarys->id]['cellPromoter'] ?></td>
                                <td><?= h($diarys->short_description_activity) ?></td>
                                <td><?= h($diarys->budget->patient->user->full_name) ?></td>
                                <td><?= h($diarys->budget->surgery) ?></td>
                                <td><?= h($diarys->budget->patient->user->cell_phone) ?></td>
                                <td><?= h($diarys->budget->patient->user->email) ?></td>
                            </tr>
                        <?php endif; ?>    
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< Anterior') ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next('Siguiente >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>