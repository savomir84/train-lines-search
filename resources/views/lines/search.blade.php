@if (isset($validation_result))
    @foreach ($validation_result['message'] as $message)
        <div class="alert alert-{{ $validation_result['status'] == 'error' ? 'danger' : 'success' }}">
            {{ $message }}
        </div>
    @endforeach
@else
    @if(!empty($lines))
        @foreach ($lines as $sub_lines)
            @if(!empty($sub_lines))
                @if($loop->count > 1)
                    <h6 class="{{ $loop->index > 0 ? 'mt-4' : ''}}">{{ $loop->iteration }}. possible route:</h6>
                @endif
                <div id="accordion-{{ $loop->index }}">
                    @foreach ($sub_lines as $line)
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#line-{{ $loop->parent->index }}-{{ $loop->index }}">
                                    {{ $line['line_details']['name'] }}
                                </a>
                            </div>
                            <div id="line-{{ $loop->parent->index }}-{{ $loop->index }}" class="collapse{{ ($loop->count == 1 && $loop->parent->index == 0 && $loop->first) ? ' show' : ''}}" data-parent="#accordion-{{ $loop->parent->index }}">
                                <div class="card-body">
                                    @if(!empty($line['places']))
                                        <ul class="list-group">
                                            @foreach ($line['places'] as $place)
                                                <li class="list-group-item list-group-item-{{ ($place['id'] == $search_parameters['from'] || $place['id'] == $search_parameters['to']) ? 'success lead font-weight-bold' : 'light' }}">{{ $place['name'] }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    @else
        <div class="alert alert-secondary">
            Sorry, we couldn't find any results.
        </div>
    @endforelse
@endif