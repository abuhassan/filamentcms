<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

use Forms\Components\Hidden;
use Forms\Components\Checkbox;
use Tables\Columns\TextColumn;
use Forms\Components\TextInput;
use Filament\Resources\Resource;
use Forms\Components\RichEditor;
use Tables\Columns\CheckboxColumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailables\Content;
use Filament\Forms\Components\Tabs\Tab;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-m-pencil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('post')->tabs([
                    Tab::make('Content')->schema         ([Forms\Components\TextInput::make('title')
                        ->required()
                        ->minLength(2),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->minLength(2),
                    Forms\Components\RichEditor::make('content')
                        ->required(),
                    Forms\Components\TextInput::make('meta_description'),
                    Forms\Components\Checkbox::make('is_published'),
                    Forms\Components\Checkbox::make('is_featured'),
                    Forms\Components\Hidden::make('user_id')
                        ->dehydrateStateUsing(fn () => Auth::id()),

                    Forms\Components\Select::make('categories')
                        ->multiple()
                        ->relationship('categories', 'title')
                ]),
                    Tab::make('Meta')->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                        ->image()
                        ->optimize('webp')
                        ->imageEditor(),
                        Forms\Components\TextInput::make('meta_description'),
                    ]),
                ])
            ])->columns(1);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\CheckboxColumn::make('is_published'),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
