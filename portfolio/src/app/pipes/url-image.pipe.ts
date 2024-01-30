import { Pipe, PipeTransform } from '@angular/core';
import { environment} from 'src/environments/environment';


@Pipe({
  name: 'urlImage'
})
export class UrlImagePipe implements PipeTransform {

  transform(url: string): string {
    return `${environment.urlApi}/storage/images/${url}`;
  }

}
