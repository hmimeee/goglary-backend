@extends('admin.layouts.app')

@section('title', 'FAQs Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('settings.index') }}">Settings</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">FAQs Management</li>
                                </ol>
                            </nav>
                            <h4 class="card-title mb-0">FAQs Management</h4>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-goglary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                                <i class="fas fa-plus me-2"></i>Add New FAQ
                            </button>
                            <a href="{{ route('settings.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Settings
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $faq)
                                    @php
                                        $faqData = json_decode($faq->value, true);
                                    @endphp
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ Str::limit($faqData['question'], 50) }}</div>
                                    </td>
                                    <td>
                                        <div>{{ Str::limit(strip_tags($faqData['answer']), 100) }}</div>
                                    </td>
                                    <td>
                                        @if($faqData['is_active'])
                                            <span class="badge badge-goglary">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $faq->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-btn-group" role="group" aria-label="FAQ actions">
                                            <button class="btn action-btn edit" title="Edit FAQ"
                                                    onclick="editFaq('{{ $faq->key }}', {{ json_encode($faqData) }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form method="POST" action="{{ route('settings.faqs.destroy', $faq->key) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn action-btn delete" title="Delete FAQ"
                                                    onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No FAQs found</h5>
                                        <p class="text-muted">Start by creating your first FAQ.</p>
                                        <button class="btn btn-goglary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                                            <i class="fas fa-plus me-2"></i>Add New FAQ
                                        </button>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('settings.faqs.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question" class="form-label required">Question</label>
                        <input type="text" class="form-control @error('question') is-invalid @enderror"
                               id="question" name="question" required>
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label required">Answer</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror"
                                  id="answer" name="answer" rows="4" required></textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                Active (Show this FAQ on the website)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-goglary">Add FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit FAQ Modal -->
<div class="modal fade" id="editFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" id="editFaqForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_question" class="form-label required">Question</label>
                        <input type="text" class="form-control" id="edit_question" name="question" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_answer" class="form-label required">Answer</label>
                        <textarea class="form-control" id="edit_answer" name="answer" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                            <label class="form-check-label" for="edit_is_active">
                                Active (Show this FAQ on the website)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-goglary">Update FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editFaq(key, faqData) {
    document.getElementById('edit_question').value = faqData.question;
    document.getElementById('edit_answer').value = faqData.answer;
    document.getElementById('edit_is_active').checked = faqData.is_active;

    const form = document.getElementById('editFaqForm');
    form.action = `/admin/settings/faqs/${key}`;

    const modal = new bootstrap.Modal(document.getElementById('editFaqModal'));
    modal.show();
}
</script>
@endpush
@endsection
