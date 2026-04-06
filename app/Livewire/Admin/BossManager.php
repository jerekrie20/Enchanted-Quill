<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\Boss;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.Layouts.admin')]
#[Title('Boss Manager')]
class BossManager extends Component
{
    public bool $showForm = false;

    public string $name = '';

    public string $description = '';

    public string $type = 'site';

    public ?int $targetId = null;

    public int $maxHp = 10000;

    public ?string $rewardCode = null;

    public ?string $startsAt = null;

    public ?string $endsAt = null;

    public ?int $editingBossId = null;

    public function getBossesProperty()
    {
        return Boss::latest()->get();
    }

    public function getAuthorsProperty()
    {
        return User::where('role', 'author')->orWhere('role', 'admin')->orderBy('name')->get();
    }

    public function getBooksProperty()
    {
        return Book::published()->with('author')->orderBy('title')->get();
    }

    public function openForm(?int $bossId = null): void
    {
        $this->resetForm();
        $this->showForm = true;

        if ($bossId) {
            $boss = Boss::findOrFail($bossId);
            $this->editingBossId = $boss->id;
            $this->name = $boss->name;
            $this->description = $boss->description ?? '';
            $this->type = $boss->type;
            $this->targetId = $boss->target_id;
            $this->maxHp = $boss->max_hp;
            $this->rewardCode = $boss->reward_code;
            $this->startsAt = $boss->starts_at?->format('Y-m-d\TH:i');
            $this->endsAt = $boss->ends_at?->format('Y-m-d\TH:i');
        }
    }

    public function saveBoss(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', 'in:site,author,book'],
            'targetId' => ['nullable', 'integer'],
            'maxHp' => ['required', 'integer', 'min:1'],
            'rewardCode' => ['nullable', 'string', 'max:255'],
            'startsAt' => ['nullable', 'date'],
            'endsAt' => ['nullable', 'date', 'after:startsAt'],
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description ?: null,
            'type' => $this->type,
            'target_id' => $this->type !== 'site' ? $this->targetId : null,
            'max_hp' => $this->maxHp,
            'reward_code' => $this->rewardCode ?: null,
            'starts_at' => $this->startsAt ?: null,
            'ends_at' => $this->endsAt ?: null,
        ];

        if ($this->editingBossId) {
            Boss::findOrFail($this->editingBossId)->update($data);
            $this->dispatch('notify', message: 'Boss updated.', type: 'success');
        } else {
            $data['current_hp'] = $this->maxHp;
            Boss::create($data);
            $this->dispatch('notify', message: 'Boss summoned!', type: 'success');
        }

        $this->resetForm();
    }

    public function toggleActive(int $bossId): void
    {
        $boss = Boss::findOrFail($bossId);
        $boss->update(['is_active' => ! $boss->is_active]);

        $label = $boss->fresh()->is_active ? 'Boss activated — it awakens!' : 'Boss deactivated.';
        $this->dispatch('notify', message: $label, type: 'success');
    }

    public function deleteBoss(int $bossId): void
    {
        Boss::findOrFail($bossId)->delete();
        $this->dispatch('notify', message: 'Boss banished.', type: 'success');
    }

    public function cancelForm(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->showForm = false;
        $this->editingBossId = null;
        $this->name = '';
        $this->description = '';
        $this->type = 'site';
        $this->targetId = null;
        $this->maxHp = 10000;
        $this->rewardCode = null;
        $this->startsAt = null;
        $this->endsAt = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.boss-manager');
    }
}
