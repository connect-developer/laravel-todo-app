<h2>TODOの追加</h2>
<form action="{{ route('todo.store') }}" method="POST">
    @csrf
    <div>
        <label for="content">
            内容
        </label>
        <textarea
            id="content"
            name="content"
            value="{{old('content')}}"
            rows="8"
        ></textarea>
    </div>
    <button type="submit">
        追加
    </button>
</form>
<h2>TODOの一覧</h2>
@if (count($todos) > 0)
<ul>
    @foreach ($todos as $todo)
    <li>
        {!! nl2br($todo->content) !!}
        <form action="{{ route('todo.update', $todo) }}" method="POST">
            @method('PUT')
            @csrf
            <div>
                <label for="status">
                    ステータス
                </label>
                <select name="status">
                    @foreach ($statuses as $value => $name)
                        <option value="{{ $value }}" {{ $todo->status == $value ? 'selected': '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">
                変更
            </button>
        </form>
        <form action="{{ route('todo.destroy', $todo) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">
                削除
            </button>
        </form>
    </li>
    @endforeach
</ul>
@else
<p>TODOはまだありません</p>
@endif
