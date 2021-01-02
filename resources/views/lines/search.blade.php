@if (isset($validation_result))
    @foreach ($validation_result['message'] as $message)
        <div class="alert alert-{{ $validation_result['status'] == 'error' ? 'danger' : 'success' }}">
            {{ $message }}
        </div>
    @endforeach
@else
    @if(!empty($lines))
        <div id="accordion">
            @foreach ($lines as $line)
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#line-{{ $line['line_details']['id'] }}">
                            {{ $line['line_details']['name'] }}
                        </a>
                    </div>
                    <div id="line-{{ $line['line_details']['id'] }}" class="collapse{{ $loop->first ? ' show' : ''}}" data-parent="#accordion">
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
    @else
        <div class="alert alert-secondary">
            Sorry, we couldn't find any results.
        </div>
    @endforelse
@endif