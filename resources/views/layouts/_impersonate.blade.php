@php
    use App\Models\User;
    $users = User::all();
@endphp

<div class="container mt-5">

    <!-- 切换用户按钮 -->
    <button type="button" class="btn btn-primary shadow rounded-circle"
            data-bs-toggle="modal" data-bs-target="#userSwitchModal"
            style="position: fixed; bottom: 5rem; right: 2rem; width: 60px; height: 60px; font-size: 1.5rem;">
        🔁
    </button>

    <!-- 模态框 -->
    <div class="modal fade" id="userSwitchModal" tabindex="-1" aria-labelledby="userSwitchModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-info text-white rounded-top-4">
                    <h5 class="modal-title" id="userSwitchModalLabel">选择用户进行切换</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        @foreach ($users as $user)
                            <div class="col-md-6">
                                <div class="card border-light shadow-sm h-100">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $user->avatar ?? asset('images/default-avatar.png') }}"
                                                 alt="avatar"
                                                 class="rounded-circle border"
                                                 style="width: 48px; height: 48px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">{{ $user->name }}</div>
                                                <div class="text-muted small">ID: {{ $user->id }}</div>
                                                <div class="text-secondary small">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                        <a href="{{ route('impersonate', ['id' => $user->id, 'redirect_to' => request()->fullUrl()]) }}"
                                           class="btn btn-sm btn-outline-info">
                                            切换
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('impersonate'))
        <div class="fixed-bottom text-end m-4">
            <a href="{{ route('stopImpersonating', ['redirect_to' => request()->fullUrl()]) }}"
               class="btn btn-warning shadow">
                🔓 恢复身份
            </a>
        </div>
    @endif
</div>
